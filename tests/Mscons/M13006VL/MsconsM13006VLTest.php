<?php

namespace Proengeno\EdiEnergy\Test\Mscons\M13006VL;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Mscons\M13006VL\MsconsM13006VLBuilder;
use Proengeno\EdiEnergy\Interfaces\Mscons\MetercountTransmissionInterface;

class MsconsM13006VLTest extends TestCase
{
    private $msconsBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->msconsBuilder = new MsconsM13006VLBuilder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(MsconsM13006VLBuilder::class, $this->msconsBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->msconsBuilder->get());
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_mscons_13006_VL_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->msconsBuilder->get());
        $this->assertEquals('MsconsM13006VL', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_sets_the_correct_GS1_qualifier()
    {
        $this->configuration->setExportSender('400');
        $this->msconsBuilder = new MsconsM13006VLBuilder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);

        $this->msconsBuilder->addMessage($this->makeMsconsMock());
        $this->edifactObject = $this->msconsBuilder->get();

        $this->assertEquals('14', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('9', $this->edifactObject->findNextSegment('NAD')->idCode());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->msconsBuilder->addMessage($this->makeMsconsMock());
        $this->edifactObject = $this->msconsBuilder->get();

        $this->assertEquals('500', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactObject->findNextSegment('NAD')->idCode());
        $this->edifactObject->validate();
    }

    private function makeMsconsMock(
        $obis = '7-20:3.0.0',
        $from = '2015-01-01',
        $until = '2016-01-01',
        $originalMessageCode = 'OriginalMessageCode',
        $meterpoint = 'DE123456',
        $meterNumber = '1234567',
        $readinReason = 'PMR',
        $readinType = 'SMV',
        $readingKind = 220,
        $readingAmount = 3500,
        $street = 'Elmstreet',
        $streetNumber = 1428,
        $city = 'Springwood',
        $zip = 26789
    )
    {
        return m::mock(MetercountTransmissionInterface::class)
            ->shouldReceive('getObis')->andReturn($obis)
            ->shouldReceive('getStartReadinDate')->andReturn(new DateTime($from))
            ->shouldReceive('getEndReadingDate')->andReturn(new DateTime($until))
            ->shouldReceive('getOriginalMessageCode')->andReturn($originalMessageCode)
            ->shouldReceive('getReportingPoint')->andReturn($meterpoint)
            ->shouldReceive('getMeterNumber')->andReturn($meterNumber)
            ->shouldReceive('getReadinReason')->andReturn($readinReason)
            ->shouldReceive('getReadinType')->andReturn($readinType)
            ->shouldReceive('getReadingKind')->andReturn($readingKind)
            ->shouldReceive('getReadingAmount')->andReturn($readingAmount)
            ->shouldReceive('getStreet')->andReturn($street)
            ->shouldReceive('getStreetNumber')->andReturn($streetNumber)
            ->shouldReceive('getCity')->andReturn($city)
            ->shouldReceive('getZip')->andReturn($zip)
            ->getMock();
    }
}
