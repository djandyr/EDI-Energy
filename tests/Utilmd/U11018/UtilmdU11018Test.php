<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11018;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11018\UtilmdU11018Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\Supplier\SupllierSignOffDeniedResponseInterface;

class UtilmdU11018Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11018Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11018', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_creates_a_denied_sign_off_because_contractually_binding()
    {
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock('Z12', date('Y-m-d'), '04WM')]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->edifactObject->validate();
        // die((string)$this->edifactObject);
    }

    /** @test */
    public function it_creates_a_denied_sign_off_because_no_contractual_relationship()
    {
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock('Z29')]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->edifactObject->validate();
        // die((string)$this->edifactObject);
    }

    /** @test */
    public function it_creates_a_denied_sign_off_because_another_supplier_signed_off_already()
    {
        $this->utilmdBuilder->addMessage([$this->makeUtilmdZ34Mock(date('Y-m-d'))]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->edifactObject->validate();
        // die((string)$this->edifactObject);
    }

    /** @test */
    public function it_creates_a_denied_sign_off_because_the_costumer_signed_off_already()
    {
        $this->utilmdBuilder->addMessage([$this->makeUtilmdZ34Mock(null, date('Y-m-d'))]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->edifactObject->validate();
        // die((string)$this->edifactObject);
    }

    /** @test */
    public function it_creates_a_denied_sign_off_because_off_some_other_reasons()
    {
        $this->utilmdBuilder->addMessage([$this->makeUtilmdE14Mock('Some wierd comment.')]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->edifactObject->validate();
        // die((string)$this->edifactObject);
    }

    private function makeUtilmdE14Mock($comment)
    {
        return $this->makeUtilmdMock('E14', null, null, 'IDE_REF', 'DE1234', $comment);
    }

    private function makeUtilmdZ34Mock($supplierSignOffDate, $customerSignOffDate = null)
    {
        return $this->makeUtilmdMock('Z34', null, null, 'IDE_REF', 'DE1234', null, $supplierSignOffDate, $customerSignOffDate);
    }

    private function makeUtilmdMock(
        $answer,
        $termDate = null,
        $noticePeriod = null,
        $ideRef = 'IDE_REF',
        $meterpoint = 'DE1234',
        $comments = null,
        $supplierSignOffDate = null,
        $customerSignOffDate = null
    )
    {
        return m::mock(SupllierSignOffDeniedResponseInterface::class)
             ->shouldReceive('getAnswer')->andReturn($answer)
             ->shouldReceive('getIdeRef')->andReturn($ideRef)
             ->shouldReceive('getComments')->andReturn($comments)
             ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
             ->shouldReceive('getRequestRef')->andReturn('REQ_REF')
             ->shouldReceive('getSupplierSignOffDate')->andReturn($supplierSignOffDate ? new DateTime($supplierSignOffDate) : null)
             ->shouldReceive('getCustomerSignOffDate')->andReturn($customerSignOffDate ? new DateTime($customerSignOffDate) : null)
             ->shouldReceive('getContractTermDate')->andReturn(new DateTime($termDate))
             ->shouldReceive('getNoticePeriod')->andReturn($noticePeriod)
             ->getMock();
    }
}
