<?php

namespace Proengeno\EdiEnergy\Test\Orders\O17103;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Orders\O17103\OrdersO17103Builder;
use Proengeno\EdiEnergy\Orders\OrdersInterface;

class OrdersBuilderTest extends TestCase 
{
    private $ordersBuilder;
    private $edifactFile;

    public function setUp()
    {
        $this->ordersBuilder = new OrdersO17103Builder('from', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
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
        $this->assertInstanceOf(OrdersO17103Builder::class, $this->ordersBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance()
    {
        $this->assertInstanceOf(Message::class, $this->edifactFile = $this->ordersBuilder->get());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->ordersBuilder->addPrebuildConfig('energyType', function() { return 'electric'; });
        $this->ordersBuilder->addMessage($this->makeOrdersMock());
        $this->edifactFile = $this->ordersBuilder->get();

        $this->assertEquals('500', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    /** @test */
    public function it_creates_a_valid_gas_message()
    {
        $this->ordersBuilder->addPrebuildConfig('energyType', function() { return 'gas'; });
        $this->ordersBuilder->addMessage($this->makeOrdersMock());
        $this->edifactFile = $this->ordersBuilder->get();

        $this->assertEquals('502', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('332', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    private function makeOrdersMock(
        $type = 7,
        $code = 'Z10',
        $street = 'Elmstreet',
        $streetNumber = 1428, 
        $city = 'Springwood', 
        $zip = 26789, 
        $meterpoint = 'DE123456', 
        $from = null, 
        $until = null
    ) {
        return m::mock(OrdersInterface::class)
            ->shouldReceive('getType')->andReturn($type)
            ->shouldReceive('getCode')->andReturn($code)
            ->shouldReceive('getStreet')->andReturn($street)
            ->shouldReceive('getStreetNumber')->andReturn($streetNumber)
            ->shouldReceive('getCity')->andReturn($city)
            ->shouldReceive('getZip')->andReturn($zip)
            ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
            ->shouldReceive('getFrom')->andReturn(new DateTime($from))
            ->shouldReceive('getUntil')->andReturn(new DateTime($until))
            ->getMock();

    }
}
