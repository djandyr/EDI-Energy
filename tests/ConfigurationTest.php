<?php

namespace Proengeno\EdiEnergy\Test;

use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Configuration;

class ConfigurationTest extends TestCase
{
    private $configuration;

    public function setUp()
    {
        $this->configuration = new Configuration;
    }

    /** @test */
    public function it_sets_an_electric_energy_type()
    {
        $this->configuration->setEnergyType('electric');

        $this->assertEquals(Configuration::ELECTRIC, $this->configuration->getEnergyType());
    }

    /** @test */
    public function it_sets_an_gas_energy_type()
    {
        $this->configuration->setEnergyType('gas');

        $this->assertEquals(Configuration::GAS, $this->configuration->getEnergyType());
    }

    /** @test */
    public function it_return_electric_energy_type_when_none_was_set()
    {
        $this->assertEquals(Configuration::ELECTRIC, $this->configuration->getEnergyType());
    }

    /**
     * @test
     * @expectedException Proengeno\Edifact\Exceptions\EdifactException
     */
    public function it_throw_an_exception_if_the_energy_type_is_unkown()
    {
        $this->configuration->setEnergyType('UNKOWN_ENERGY');
    }
}
