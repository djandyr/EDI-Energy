<?php

namespace Proengeno\EdiEnergy\Test\Orders\O17102;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Orders\OrdersInterface;
use Proengeno\EdiEnergy\Orders\O17102\OrdersO17102Builder;
use Proengeno\Edifact\Exceptions\EdifactException;

class OrdersBuilderTest extends TestCase
{
    private $ordersBuilder;
    private $edifactObject;

    public function setUp()
    {
        $this->ordersBuilder = new OrdersO17102Builder('from', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
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
        $this->assertInstanceOf(OrdersO17102Builder::class, $this->ordersBuilder);
    }

    /** @test */
    public function it_sets_the_correct_GS1_qualifier()
    {
        $this->ordersBuilder = new OrdersO17102Builder('400', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));

        $this->ordersBuilder->addMessage($this->makeOrdersMock());
        $this->edifactObject = $this->ordersBuilder->get();

        $this->assertEquals('14', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('9', $this->edifactObject->findNextSegment('NAD')->idCode());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->ordersBuilder->addMessage($this->makeOrdersMock());
        $this->edifactObject = $this->ordersBuilder->get();

        $this->assertEquals('500', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactObject->findNextSegment('NAD')->idCode());
        $this->edifactObject->validate();
    }

    /** @test */
    public function it_build_up_the_Message_instance()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->ordersBuilder->get());
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_orders_17102_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->ordersBuilder->get());
        $this->assertEquals('OrdersO17102', $this->edifactObject->getAdapterName());
    }

    private function makeOrdersMock(
        $type = 7,
        $code = 'Z12',
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
