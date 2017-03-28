<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11018;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11018\UtilmdU11018Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierSupllierSigningOffInterface;

class UtilmdU11018Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11018Builder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11018', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_creates_a_valid_denied_sign_off_answer()
    {
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock('Z29')]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->edifactObject->validate();
        (string)$this->edifactObject;
    }

    // /** @test */
    // public function it_creates_a_valid_denied_no_contract_sign_off_answer()
    // {
    //     $termDate = (new DateTime)->modify('+1 YEAR');
    //     $this->utilmdBuilder->addMessage([$this->makeUtilmdMock('Z12', $termDate->format('Y-m-d'), '01MM')]);
    //     $this->edifactObject = $this->utilmdBuilder->get();

    //     $this->edifactObject->validate();
    //     (string)$this->edifactObject;
    // }

    private function makeUtilmdMock(
        $answer,
        $termDate = null,
        $noticePeriod = null,
        $ideRef = 'IDE_REF',
        $meterpoint = 'DE1234',
        $comments = null
    )
    {
        return m::mock(SupplierSupllierSigningOffInterface::class)
             ->shouldReceive('getAnswer')->andReturn($answer)
             ->shouldReceive('getIdeRef')->andReturn($ideRef)
             ->shouldReceive('getComments')->andReturn($comments)
             ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
             ->shouldReceive('getRequestRef')->andReturn('REQ_REF')
             ->shouldReceive('getContractTermDate')->andReturn(new DateTime($termDate))
             ->shouldReceive('getNoticePeriod')->andReturn($noticePeriod)
             ->getMock();
    }
}
