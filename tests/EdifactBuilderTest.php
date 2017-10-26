<?php

namespace Proengeno\EdiEnergy\Test;

use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Configuration;
use Proengeno\EdiEnergy\EdifactBuilder;
use Proengeno\EdiEnergy\Test\Fixtures\BuilderFixture;

class EdifactBuilderTest extends TestCase
{
    /** @test*/
    public function it_provides_an_electric_energy_type_if_none_is_configured()
    {
        $builder = new BuilderFixture('to', $this->configuration);

        $this->assertEquals('electric', $builder->getEnergyType());
    }

    /** @test*/
    public function it_can_provides_the_configures_energy_type()
    {
        $configuration = new Configuration;
        $configuration->setEnergyType('gas');

        $builder = new BuilderFixture('to', $configuration);

        $this->assertEquals('gas', $builder->getEnergyType());
    }

    /** @test*/
    public function it_can_generated_a_filename()
    {
        $configuration = new Configuration;
        $configuration->setEnergyType('gas');
        $configuration->setExportSender('from');
        $configuration->setUnbRefGenerator(function() { return 'REF';});

        $builder = new BuilderFixture('to', $configuration);

        $this->assertEquals('TEST_SUB_TYPE_from_to_' . date('Ymd') . '_REF.txt', $builder->generateFilename());
    }

    /**
     * @test
     * @dataProvider unbRegexProvider
     */
    public function it_write_the_unb_segment($energyType, $sender, $receiver, $unbRef, $regex)
    {
        $configuration = new Configuration;
        $configuration->setEnergyType($energyType);
        $configuration->setExportSender($sender);
        $configuration->setUnbRefGenerator(function() use ($unbRef) { return $unbRef; });

        $builder = new BuilderFixture($receiver, $configuration);
        $builder->testWriteUnb();

        $this->assertRegExp($regex, $builder->getFileContent());
    }

    public function unbRegexProvider()
    {
        return [
            ['gas', '900', '901', 'REF123', '/UNB\+UNOC\:3\+900\:502\+901\:502\+[0-9]{6}\:[0-9]{4}\+REF123\+\+SUB_TYPE\'/'],
            ['gas', '900', '901', 'REF', '/UNB\+UNOC\:3\+900\:502\+901\:502\+[0-9]{6}\:[0-9]{4}\+REF\+\+SUB_TYPE\'/'],
            ['gas', '400', '901', 'REF', '/UNB\+UNOC\:3\+400\:14\+901\:502\+[0-9]{6}\:[0-9]{4}\+REF\+\+SUB_TYPE\'/'],
            ['gas', '900', '400', 'REF', '/UNB\+UNOC\:3\+900\:502\+400\:14\+[0-9]{6}\:[0-9]{4}\+REF\+\+SUB_TYPE\'/'],
            ['gas', '900', '901', 'REF321', '/UNB\+UNOC\:3\+900\:502\+901\:502\+[0-9]{6}\:[0-9]{4}\+REF321\+\+SUB_TYPE\'/'],
            ['electric', '900', '901', 'REF', '/UNB\+UNOC\:3\+900\:500\+901\:500\+[0-9]{6}\:[0-9]{4}\+REF\+\+SUB_TYPE\'/'],
            ['electric', '400', '901', 'REF', '/UNB\+UNOC\:3\+400\:14\+901\:500\+[0-9]{6}\:[0-9]{4}\+REF\+\+SUB_TYPE\'/'],
            ['electric', '900', '400', 'REF', '/UNB\+UNOC\:3\+900\:500\+400\:14\+[0-9]{6}\:[0-9]{4}\+REF\+\+SUB_TYPE\'/'],
            ['electric', '400', '400', 'REF', '/UNB\+UNOC\:3\+400\:14\+400\:14\+[0-9]{6}\:[0-9]{4}\+REF\+\+SUB_TYPE\'/'],
        ];
    }
}
