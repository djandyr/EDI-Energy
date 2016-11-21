<?php

namespace Proengeno\EdiEnergy\Test;

use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Configuration;
use Proengeno\Edifact\Message\Message;

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
     * @dataProvider messageProvider
     **/
    public function it_sets_the_correct_description_configuration($ediString, $messageName)
    {
        $message = Message::fromString($ediString, new Configuration);

        $this->assertEquals($messageName, $message->getDescription('name'));
    }

    /**
     * @test
     * @expectedException Proengeno\Edifact\Exceptions\EdifactException
     */
    public function it_throw_an_exception_if_the_energy_type_is_unkown()
    {
        $this->configuration->setEnergyType('UNKOWN_ENERGY');
    }

    public function messageProvider()
    {
        return [
            // ORDERS
            ["UNH++ORDERS:'RFF+Z13:17102", 'OrdersO17102'],
            ["UNH++ORDERS:'RFF+Z13:17103", 'OrdersO17103'],

            // MSCONS
            ["UNH++MSCONS:'RFF+Z13:13002", 'MsconsM13002VL'],
            ["UNB+++VL'UNH++MSCONS:'RFF+Z13:13006", 'MsconsM13006VL'],
            ["UNB+++EM'UNH++MSCONS:'RFF+Z13:13006", 'MsconsM13006EM'],
            ["UNB+++EM'UNH++MSCONS:'RFF+Z13:13009", 'MsconsM13009EM'],
            ["UNB+++EM'UNH++MSCONS:'RFF+Z13:13013", 'MsconsM13013EM'],
            ["UNB+++EM'UNH++MSCONS:'RFF+Z13:13014", 'MsconsM13014EM'],

            // REMADV
            ["UNH++REMADV:'RFF+Z13:33001", 'RemadvR33001'],

            //ULTLMD
            ["UNH++UTILMD:'RFF+Z13:11002", 'UtilmdU11002'],
            ["UNH++UTILMD:'RFF+Z13:11003", 'UtilmdU11003'],
            ["UNH++UTILMD:'RFF+Z13:11005", 'UtilmdU11005'],
            ["UNH++UTILMD:'RFF+Z13:11006", 'UtilmdU11006'],
            ["UNH++UTILMD:'RFF+Z13:11007", 'UtilmdU11007'],
            ["UNH++UTILMD:'RFF+Z13:11010", 'UtilmdU11010'],
            ["UNH++UTILMD:'RFF+Z13:11016", 'UtilmdU11016'],
            ["UNH++UTILMD:'RFF+Z13:11017", 'UtilmdU11017'],
            ["UNH++UTILMD:'RFF+Z13:11018", 'UtilmdU11018'],
            ["UNH++UTILMD:'RFF+Z13:11022", 'UtilmdU11022'],
            ["UNH++UTILMD:'RFF+Z13:11023", 'UtilmdU11023'],
            ["UNH++UTILMD:'RFF+Z13:11024", 'UtilmdU11024'],
            ["UNH++UTILMD:'RFF+Z13:11036", 'UtilmdU11036'],
            ["UNH++UTILMD:'RFF+Z13:11037", 'UtilmdU11037'],
            ["UNH++UTILMD:'RFF+Z13:11038", 'UtilmdU11038'],
        ];
    }
}
