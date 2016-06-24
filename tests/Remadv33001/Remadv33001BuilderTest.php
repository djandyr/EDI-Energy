<?php

namespace Proengeno\EdiEnergy\Test\Remadv33001;

use DateTime;
use SplFileInfo;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Interfaces\RemadvInterface;
use Proengeno\EdiEnergy\Remadv\R33001\RemadvR33001;
use Proengeno\EdiEnergy\Remadv\R33001\RemadvR33001Builder;

class Remadv33001BuilderTest extends TestCase 
{
    private $remadvBuilder;
    private $edifactFile;

    public function setUp()
    {
        $this->remadvBuilder = new RemadvR33001Builder('from', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
    }

    public function tearDown()
    {
        if ($this->edifactFile) {
            @unlink($this->edifactFile->getFilepath());
        }
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(RemadvR33001Builder::class, $this->remadvBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance()
    {
        $this->assertInstanceOf(Message::class, $this->edifactFile = $this->remadvBuilder->get());
    }

    /** @test */
    public function it_add_pre_build_charset_conversion_configuration()
    {
        $utf8String = 'ß';
        $isoString = iconv('UTF-8', 'CP1252', $utf8String);

        $this->remadvBuilder->addPrebuildConfig('convertCharset', function($string) {
            if ($connvertedString = iconv('UTF-8', 'CP1252', $string)) {
                return $connvertedString;
            }
            return $string;
        });
        $this->remadvBuilder->addPrebuildConfig('energyType', 'electric');
        $this->remadvBuilder->addMessage([$this->makeRemadvMock(1, 1, 1, date('Y-m-d'), $utf8String)]);
        $this->edifactFile = $this->remadvBuilder->get();

        $this->assertEquals($isoString, $this->edifactFile->findNextSegment('DOC')->code());
    }

    /** @test */
    public function it_add_post_build_charset_conversion_configuration()
    {
        $utf8String = 'ß';
        $isoString = iconv('UTF-8', 'CP1252', $utf8String);

        $this->remadvBuilder->addPostbuildConfig('convertCharset', function($string) {
            $encoding = mb_detect_encoding($string, 'UTF-8, CP1252, ISO-8859-1');
            if ($encoding && $connvertedString = iconv($encoding, 'UTF-8', $string)) {
                return $connvertedString;
            }
            return $string;
        });
        $this->remadvBuilder->addPrebuildConfig('energyType', 'electric');
        $this->remadvBuilder->addMessage([$this->makeRemadvMock(1, 1, 1, date('Y-m-d'), $isoString)]);
        $this->edifactFile = $this->remadvBuilder->get();

        $this->assertEquals($utf8String, $this->edifactFile->findNextSegment('DOC')->code());
    }
    
    /** @test */
    public function it_generates_a_costum_unb_ref()
    {
        $this->remadvBuilder->addPrebuildConfig('energyType', 'electric');
        $this->remadvBuilder->addMessage([$this->makeRemadvMock()]);

        //$this->assertStringStartsWith('R', $this->remadvBuilder->unbReference());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->remadvBuilder->addPrebuildConfig('energyType', 'electric');
        $this->remadvBuilder->addMessage([$this->makeRemadvMock()]);
        $this->edifactFile = $this->remadvBuilder->get();

        $this->assertEquals('500', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    /** @test */
    public function it_creates_a_valid_gas_message()
    {
        $this->remadvBuilder->addPrebuildConfig('energyType', 'gas');
        $this->remadvBuilder->addMessage([$this->makeRemadvMock()]);
        $this->remadvBuilder->addMessage([$this->makeRemadvMock(15.5)]);
        $this->edifactFile = $this->remadvBuilder->get();

        $this->assertEquals('502', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('332', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    /** @test */
    public function compare_with_template_gas_invoice()
    {
        $this->remadvBuilder->addPrebuildConfig('unbReference', 'UNB-REF');
        $this->remadvBuilder->addPrebuildConfig('energyType', 'gas');
        $this->remadvBuilder->addMessage([$this->makeRemadvMock(), $this->makeRemadvMock(15.5)]);
        $this->remadvBuilder->addMessage([$this->makeRemadvMock(15.5), $this->makeRemadvMock(15.5)]);
        $this->edifactFile = $this->remadvBuilder->get();
        
        $this->assertEquals($this->getGasInvoiceTemplate(), (string)$this->edifactFile);
    }

    /** @test */
    public function compare_with_template_electric_invoice()
    {
        $this->remadvBuilder->addPrebuildConfig('unbReference', 'UNB-REF');
        $this->remadvBuilder->addPrebuildConfig('energyType', 'electric');
        $this->remadvBuilder->addMessage([$this->makeRemadvMock(), $this->makeRemadvMock(15.5)]);
        $this->remadvBuilder->addMessage([$this->makeRemadvMock(15.5), $this->makeRemadvMock(15.5)]);
        $this->edifactFile = $this->remadvBuilder->get();

        $this->assertEquals($this->getElectricInvoiceTemplate(), (string)$this->edifactFile);
    }

    private function makeRemadvMock($payedAmount = 10, $invoiceAmount = 10, $accountNumber = 1, $invoiceDate = '2015-01-01', $invoiceCode = 380)
    {
        return m::mock(RemadvInterface::class)
            ->shouldReceive('getPayedAmount')->andReturn($payedAmount)
            ->shouldReceive('getInvoiceAmount')->andReturn($invoiceAmount)
            ->shouldReceive('getAccountNumber')->andReturn($accountNumber)
            ->shouldReceive('getInvoiceDate')->andReturn(new DateTime($invoiceDate))
            ->shouldReceive('getInvoiceCode')->andReturn($invoiceCode)
            ->getMock();

    }

    private function getGasInvoiceTemplate()
    {
        return "UNA:+.? 'UNB+UNOC:3+from:502+to:502+" . date('ymd:hi') . "+UNB-REF'UNH+UNB-REF0+REMADV:D:05A:UN:2.7b'BGM+481+UNB-REF0'DTM+137:" . date('Ymd') . ":102'RFF+Z13:33001'NAD+MS+from::332'CTA+IC+:Frau Jacobs'COM+04958 91570-08:TE'COM+a.jacobs@proengeno.de:EM'NAD+MR+to::332'CUX+2:EUR:11'DOC+380+1'MOA+9:10.00'MOA+12:10.00'DTM+137:20150101:102'DOC+380+1'MOA+9:10.00'MOA+12:15.50'DTM+137:20150101:102'UNS+S'MOA+12:25.50'UNT+21+UNB-REF0'UNH+UNB-REF1+REMADV:D:05A:UN:2.7b'BGM+481+UNB-REF1'DTM+137:" . date('Ymd') . ":102'RFF+Z13:33001'NAD+MS+from::332'CTA+IC+:Frau Jacobs'COM+04958 91570-08:TE'COM+a.jacobs@proengeno.de:EM'NAD+MR+to::332'CUX+2:EUR:11'DOC+380+1'MOA+9:10.00'MOA+12:15.50'DTM+137:20150101:102'DOC+380+1'MOA+9:10.00'MOA+12:15.50'DTM+137:20150101:102'UNS+S'MOA+12:56.50'UNT+21+UNB-REF1'UNZ+2+UNB-REF'";
    }

    private function getElectricInvoiceTemplate()
    {
        return "UNA:+.? 'UNB+UNOC:3+from:500+to:500+" . date('ymd:hi') . "+UNB-REF'UNH+UNB-REF0+REMADV:D:05A:UN:2.7b'BGM+481+UNB-REF0'DTM+137:" . date('Ymd') . ":102'RFF+Z13:33001'NAD+MS+from::293'CTA+IC+:Frau Jacobs'COM+04958 91570-08:TE'COM+a.jacobs@proengeno.de:EM'NAD+MR+to::293'CUX+2:EUR:11'DOC+380+1'MOA+9:10.00'MOA+12:10.00'DTM+137:20150101:102'DOC+380+1'MOA+9:10.00'MOA+12:15.50'DTM+137:20150101:102'UNS+S'MOA+12:25.50'UNT+21+UNB-REF0'UNH+UNB-REF1+REMADV:D:05A:UN:2.7b'BGM+481+UNB-REF1'DTM+137:" . date('Ymd') . ":102'RFF+Z13:33001'NAD+MS+from::293'CTA+IC+:Frau Jacobs'COM+04958 91570-08:TE'COM+a.jacobs@proengeno.de:EM'NAD+MR+to::293'CUX+2:EUR:11'DOC+380+1'MOA+9:10.00'MOA+12:15.50'DTM+137:20150101:102'DOC+380+1'MOA+9:10.00'MOA+12:15.50'DTM+137:20150101:102'UNS+S'MOA+12:56.50'UNT+21+UNB-REF1'UNZ+2+UNB-REF'";
    }
}
