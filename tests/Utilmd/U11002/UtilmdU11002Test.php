<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11002;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11002\UtilmdU11002Builder;

class UtilmdU11002Test extends TestCase 
{
    private $utilmdBuilder;
    private $edifactObject;

    public function setUp()
    {
        $this->utilmdBuilder = new UtilmdU11002Builder('from', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
    }

    public function tearDown()
    {
        if ($this->edifactObject) {
            @unlink($this->edifactObject->getFilepath());
        }
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(UtilmdU11002Builder::class, $this->utilmdBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_mscons_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11002', $this->edifactObject->getAdapterName());
    }

    /** @test */
    public function it_sets_the_correct_GS1_qualifier()
    {
        $this->utilmdBuilder = new UtilmdU11002Builder('400', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));

        $this->utilmdBuilder->addPrebuildConfig('energyType', 'electric');
        $this->utilmdBuilder->addMessage($this->makeUtilmdMock());
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->assertEquals('14', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('9', $this->edifactObject->findNextSegment('NAD')->idCode());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->utilmdBuilder->addPrebuildConfig('energyType', 'electric');
        $this->utilmdBuilder->addMessage($this->makeUtilmdMock());
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->edifactObject->validate();
    }

//    /** @test */
//    public function it_creates_a_valid_gas_message()
//    {
//        $this->utilmdBuilder->addPrebuildConfig('energyType', 'gas');
//        $this->utilmdBuilder->addMessage($this->makeUtilmdMock());
//        $this->edifactObject = $this->utilmdBuilder->get();
//
//        $this->assertEquals('502', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
//        $this->assertEquals('332', $this->edifactObject->findNextSegment('NAD')->idCode());
//        $this->edifactObject->validate();
//    }
//
    private function makeUtilmdMock(
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
