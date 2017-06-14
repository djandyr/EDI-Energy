<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11139;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11139\UtilmdU11139Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierNoBalancingChangeRequestInterface;

class UtilmdU11139Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11139Builder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(UtilmdU11139Builder::class, $this->utilmdBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_11139_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11139', $this->edifactObject->getDescription('name'));
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
        $changesStart = 'Y-m-01',
        $marketArea = 'BALANCING_AREA',
        $firstName = 'Max',
        $lastName = 'Mustermann',
        $company = 'Company',
        $city = 'City',
        $street = 'Street',
        $streetNo = '2b',
        $zip = '26844',
        $meterpoint = 'DE123'
    ) {
        return m::mock(SupplierNoBalancingChangeRequestInterface::class)
            ->shouldReceive('getIdeRef')->andReturn($ideRef)
            ->shouldReceive('getContractStart')->andReturn(new \DateTime(date($contractStart)))
            ->shouldReceive('getChangesStart')->andReturn(new \DateTime(date($changesStart)))
            ->shouldReceive('hasMarketAreaChange')->andReturn(true)
            ->shouldReceive('getMarketArea')->andReturn($marketArea)
            ->shouldReceive('hasDeliveryNameChange')->andReturn(true)
            ->shouldReceive('getFirstName')->andReturn($firstName)
            ->shouldReceive('getLastName')->andReturn($lastName)
            ->shouldReceive('hasDeliveryCompanyChange')->andReturn(true)
            ->shouldReceive('getCompany')->andReturn($company)
            ->shouldReceive('hasDeliveryAddressChange')->andReturn(true)
            ->shouldReceive('getCity')->andReturn($city)
            ->shouldReceive('getStreet')->andReturn($street)
            ->shouldReceive('getStreetNo')->andReturn($streetNo)
            ->shouldReceive('getZip')->andReturn($zip)
            ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
            ->getMock();
    }
}
