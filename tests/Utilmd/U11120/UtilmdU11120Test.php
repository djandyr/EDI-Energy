<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11120;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11120\UtilmdU11120Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierBalancingChangeInterface;

class UtilmdU11120Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11120Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'));
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(UtilmdU11120Builder::class, $this->utilmdBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_11120_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11120', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock(), $this->makeUtilmdMock()]);
        $this->edifactObject = $this->utilmdBuilder->get();
        $this->edifactObject->validateSegments();

        $this->assertEquals('electric', $this->edifactObject->getConfiguration('energyType'));
    }

    private function makeUtilmdMock(
        $ideRef = 'IDE_REF',
        $contractStart = 'Y-m-d',
        $getChangesStart = 'Y-m-01',
        $getBalancingArea = 'BALANCING_AREA',
        $meterpoint = 'DE123',
        $meterpointType = 'Z71'
    ) {
        return m::mock(SupplierBalancingChangeInterface::class)
            ->shouldReceive('getIdeRef')->andReturn($ideRef)
            ->shouldReceive('getContractStart')->andReturn(new \DateTime(date($contractStart)))
            ->shouldReceive('getChangesStart')->andReturn(new \DateTime(date($contractStart)))
            ->shouldReceive('hasBalancingAreaChange')->andReturn(true)
            ->shouldReceive('getBalancingArea')->andReturn($getBalancingArea)
            ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
            ->shouldReceive('getMeterpointType')->andReturn($meterpointType)
            ->getMock();
    }
}
