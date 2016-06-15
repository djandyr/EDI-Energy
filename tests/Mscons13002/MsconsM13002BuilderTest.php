<?php

namespace Proengeno\EdiEnergy\Test\Remadv33001;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Interfaces\MsconsVlInterface;
use Proengeno\EdiEnergy\Mscons\M13002\MsconsM13002Builder;

class MsconsM13002BuilderTest extends TestCase 
{
    private $msconsBuilder;
    private $edifactFile;

    public function setUp()
    {
        $this->msconsBuilder = new MsconsM13002Builder('from', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
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
        $this->assertInstanceOf(MsconsM13002Builder::class, $this->msconsBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance()
    {
        $this->assertInstanceOf(Message::class, $this->edifactFile = $this->msconsBuilder->get());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->msconsBuilder->addPrebuildConfig('energyType', 'electric');
        $this->msconsBuilder->addMessage($this->makeMsconsMock());
        $this->edifactFile = $this->msconsBuilder->get();

        $this->assertEquals('500', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    /** @test */
    public function it_creates_a_valid_gas_message()
    {
        $this->msconsBuilder->addPrebuildConfig('energyType', 'gas');
        $this->msconsBuilder->addMessage($this->makeMsconsMock());
        $this->edifactFile = $this->msconsBuilder->get();

        $this->assertEquals('502', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('332', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    private function makeMsconsMock(
        $obis = '7-20:3.0.0', 
        $from = '2015-01-01', 
        $until = '2016-01-01', 
        $ordesCode = 'OrdersCode',
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
        return m::mock(MsconsVlInterface::class)
            ->shouldReceive('getObis')->andReturn($obis)
            ->shouldReceive('getFrom')->andReturn(new DateTime($from))
            ->shouldReceive('getUntil')->andReturn(new DateTime($until))
            ->shouldReceive('getOrdersCode')->andReturn($ordesCode)
            ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
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
