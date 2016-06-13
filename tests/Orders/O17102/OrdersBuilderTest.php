<?php

namespace Proengeno\EdiMessages\Test\Orders\O17102;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\EdiMessages\Orders\OrdersInterface;
use Proengeno\EdiMessages\Orders\O17102\OrdersO17102Builder;

class OrdersBuilderTest extends TestCase 
{
    private $ordersBuilder;
    private $edifactFile;

    public function setUp()
    {
        $this->ordersBuilder = new OrdersO17102Builder('from', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
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
        $this->assertInstanceOf(OrdersO17102Builder::class, $this->ordersBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance()
    {
        $this->assertInstanceOf(Message::class, $this->edifactFile = $this->ordersBuilder->get());
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->ordersBuilder->setEnergieType('electric');
        $this->ordersBuilder->addMessage($this->makeOrdersMock());
        $this->edifactFile = $this->ordersBuilder->get();

        $this->assertEquals('500', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('293', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
    }

    /** @test */
    public function it_creates_a_valid_gas_message()
    {
        $this->ordersBuilder->setEnergieType('gas');
        $this->ordersBuilder->addMessage($this->makeOrdersMock());
        $this->edifactFile = $this->ordersBuilder->get();

        $this->assertEquals('502', $this->edifactFile->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('332', $this->edifactFile->findNextSegment('NAD')->idCode());
        $this->edifactFile->validate();
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
