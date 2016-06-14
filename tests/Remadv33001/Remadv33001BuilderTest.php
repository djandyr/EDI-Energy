<?php

namespace Proengeno\EdiEnergy\Test\Remadv33001;

use DateTime;
use SplFileInfo;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Remadv\RemadvInterface;
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
        $this->remadvBuilder->addPrebuildConfig('energyType', function() { return 'electric'; });
        $this->remadvBuilder->addMessage($this->makeRemadvMock(1, 1, 1, date('Y-m-d'), $utf8String));
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
        $this->remadvBuilder->addPrebuildConfig('energyType', function() { return 'electric'; });
        $this->remadvBuilder->addMessage($this->makeRemadvMock(1, 1, 1, date('Y-m-d'), $isoString));
        $this->edifactFile = $this->remadvBuilder->get();

        $this->assertEquals($utf8String, $this->edifactFile->findNextSegment('DOC')->code());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->remadvBuilder->addPrebuildConfig('energyType', function() { return 'electric'; });
        $this->remadvBuilder->addMessage($this->makeRemadvMock());
        $this->edifactFile = $this->remadvBuilder->get();

        $this->assertEquals('500', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    /** @test */
    public function it_creates_a_valid_gas_message()
    {
        $this->remadvBuilder->addPrebuildConfig('energyType', function() { return 'gas'; });
        $this->remadvBuilder->addMessage($this->makeRemadvMock());
        $this->remadvBuilder->addMessage($this->makeRemadvMock(15.5));
        $this->edifactFile = $this->remadvBuilder->get();

        $this->assertEquals('502', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('332', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
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
    
}
