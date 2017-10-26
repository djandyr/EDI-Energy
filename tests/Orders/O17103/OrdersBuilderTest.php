<?php

namespace Proengeno\EdiEnergy\Test\Orders\O17103;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Interfaces\OrdersInterface;
use Proengeno\EdiEnergy\Orders\O17103\OrdersO17103Builder;

class OrdersBuilderTest extends TestCase
{
    private $ordersBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->ordersBuilder = new OrdersO17103Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'));
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
    public function it_build_up_the_Message_instance_with_orders_17103_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->ordersBuilder->get());
        $this->assertEquals('OrdersO17103', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_sets_the_correct_GS1_qualifier()
    {
        $this->configuration->setExportSender('400');

        $this->ordersBuilder = new OrdersO17103Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'));

        $this->ordersBuilder->addMessage($this->makeOrdersMock());
        $this->edifactObject = $this->ordersBuilder->get();

        $this->assertEquals('14', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('9', $this->edifactObject->findNextSegment('NAD')->idCode());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->ordersBuilder->addMessage($this->makeOrdersMock());
        $this->edifactFile = $this->ordersBuilder->get();

        $this->assertEquals('500', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactFile->findNextSegment('NAD')->idCode());
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
