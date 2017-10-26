<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11109;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11109\UtilmdU11109Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierNoBalancingChangeInterface;

class UtilmdU11109Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11109Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'));
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(UtilmdU11109Builder::class, $this->utilmdBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_11109_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11109', $this->edifactObject->getDescription('name'));
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
        $firstname = 'Max',
        $lastname = 'Mustermann',
        $company = 'Company',
        $meterpoint = 'DE123'
    ) {
        return m::mock(SupplierNoBalancingChangeInterface::class)
            ->shouldReceive('getIdeRef')->andReturn($ideRef)
            ->shouldReceive('getContractStart')->andReturn(new \DateTime(date($contractStart)))
            ->shouldReceive('getChangesStart')->andReturn(new \DateTime(date($contractStart)))
            ->shouldReceive('hasNameChange')->andReturn(true)
            ->shouldReceive('getLastName')->andReturn($lastname)
            ->shouldReceive('getFirstName')->andReturn($firstname)
            ->shouldReceive('hasCompanyChange')->andReturn(true)
            ->shouldReceive('getCompany')->andReturn($company)
            ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
            ->getMock();
    }
}
