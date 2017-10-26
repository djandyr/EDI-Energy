<?php

namespace Proengeno\EdiEnergy\Test\Remadv\R33002;

use DateTime;
use SplFileInfo;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Remadv\R33002\RemadvR33002;
use Proengeno\EdiEnergy\Remadv\R33002\RemadvR33002Builder;
use Proengeno\EdiEnergy\Interfaces\Remadv\RejectedPaymentsInterface;

class Remadv33002BuilderTest extends TestCase
{
    private $remadvBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->remadvBuilder = new RemadvR33002Builder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(RemadvR33002Builder::class, $this->remadvBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->remadvBuilder->get());
    }

    /** @test */
    public function it_converts_the_input_to_iso_and_the_output_from_iso_to_utf8()
    {
        $filename = tempnam(sys_get_temp_dir(), 'EdifactTest');
        $utf8String = 'ß';
        $isoString = iconv('UTF-8', 'CP1252', $utf8String);

        $remadvBuilder = new RemadvR33002Builder('to', $filename, $this->configuration);
        $remadvBuilder->addMessage([$this->makeRemadvMock('Z08', 1, 1, date('Y-m-d'), $isoString)]);

        $this->assertContains($isoString, file_get_contents($filename));
        $this->assertContains($utf8String, (string)$remadvBuilder->get());
    }

    /** @test */
    public function it_generates_a_costum_unb_ref()
    {
        $this->remadvBuilder->addMessage([$this->makeRemadvMock()]);

        //$this->assertStringStartsWith('R', $this->remadvBuilder->unbReference());
    }

    /** @test */
    public function it_sets_the_correct_GS1_qualifier()
    {
        $this->configuration->setExportSender('400');

        $this->remadvBuilder = new RemadvR33002Builder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);

        $this->remadvBuilder->addMessage([$this->makeRemadvMock()]);
        $this->edifactObject = $this->remadvBuilder->get();

        $this->assertEquals('14', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('9', $this->edifactObject->findNextSegment('NAD')->idCode());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->remadvBuilder->addMessage([$this->makeRemadvMock()]);
        $this->edifactObject = $this->remadvBuilder->get();

        $this->assertEquals('500', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactObject->findNextSegment('NAD')->idCode());
        $this->edifactObject->validate();
    }

    private function makeRemadvMock($answer = 'Z08', $invoiceAmount = 10, $accountNumber = 1, $invoiceDate = '2015-01-01', $invoiceCode = 380)
    {
        return m::mock(RejectedPaymentsInterface::class)
            ->shouldReceive('getInvoiceAmount')->andReturn($invoiceAmount)
            ->shouldReceive('getAccountNumber')->andReturn($accountNumber)
            ->shouldReceive('getInvoiceDate')->andReturn(new DateTime($invoiceDate))
            ->shouldReceive('getInvoiceCode')->andReturn($invoiceCode)
            ->shouldReceive('getComments')->andReturn(null)
            ->shouldReceive('getAnswer')->andReturn($answer)
            ->getMock();
    }
}
