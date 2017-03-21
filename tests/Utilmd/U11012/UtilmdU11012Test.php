<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11012;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11012\UtilmdU11012Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierGridOperationSigningOffInterface;

class UtilmdU11012Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11012Builder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11012', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_creates_a_valid_default_message()
    {
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock('E03', '2017-01-01')]);

        $this->utilmdBuilder->getOrFail();
    }

    private function makeUtilmdMock(
        $reason,
        $signOffDate,
        $answer = 'E17',
        $meterpoint = 'DE12343',
        $ideRef = 'IDE_REF',
        $requestRef = 'TN_REF'
    )
    {
        return m::mock(SupplierGridOperationSigningOffInterface::class)
            ->shouldReceive('getIdeRef')->andReturn($ideRef)
            ->shouldReceive('getReason')->andReturn($reason)
            ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
            ->shouldReceive('getAnswer')->andReturn($answer)
            ->shouldReceive('getRequestRef')->andReturn($requestRef)
            ->shouldReceive('getSignOffDate')->andReturn(new DateTime($signOffDate))
            ->getMock();
    }
}
