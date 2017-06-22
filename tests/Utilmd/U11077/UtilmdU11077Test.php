<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11077;

use DateTime;
use Mockery as m;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Utilmd\U11077\UtilmdU11077Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierGridOperationSigningOnInterface;

class UtilmdU11077Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11077Builder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(UtilmdU11077Builder::class, $this->utilmdBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_11077_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11077', $this->edifactObject->getDescription('name'));
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
        $reason = 'E03',
        $saleForm = 'Z19',
        $meterpoint = 'DE123',
        $signOn = 'Y-m-d',
        $paymentReceiver = 'E09',
        $divisionPercent = '100',
        $balancingGroup = 'BALANCING_GROUP',
        $remoteControlCapability = 'Z27'
    ) {
        return m::mock(SupplierGridOperationSigningOnInterface::class)
            ->shouldReceive('getIdeRef')->andReturn($ideRef)
            ->shouldReceive('getReason')->andReturn($reason)
            ->shouldReceive('getSaleForm')->andReturn($saleForm)
            ->shouldReceive('getRemoteControlCapability')->andReturn($remoteControlCapability)
            ->shouldReceive('getPaymentReceiver')->andReturn($paymentReceiver)
            ->shouldReceive('getSignOnDate')->andReturn(new \DateTime(date($signOn)))
            ->shouldReceive('getBalancingGroup')->andReturn($balancingGroup)
            ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
            ->shouldReceive('getDivisionPercent')->andReturn($divisionPercent)
            ->getMock();
    }
}
