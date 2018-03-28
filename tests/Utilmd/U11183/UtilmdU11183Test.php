<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11183;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11183\UtilmdU11183Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierNoBalancingChangeRequestInterface;

class UtilmdU11183Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        m::getConfiguration()->allowMockingNonExistentMethods(true);
        $this->utilmdBuilder = new UtilmdU11183Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'));
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(UtilmdU11183Builder::class, $this->utilmdBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_11183_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11183', $this->edifactObject->getDescription('name'));
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
        $meterpoint = 'DE123'
    ) {
        return m::mock('DummyClass')
            ->shouldReceive('getIdeRef')->andReturn($ideRef)
            ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
            ->getMock();
    }
}
