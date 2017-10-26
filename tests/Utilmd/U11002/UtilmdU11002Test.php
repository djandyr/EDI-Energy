<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11002;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11002\UtilmdU11002Builder;

class UtilmdU11002Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11002Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'));
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(UtilmdU11002Builder::class, $this->utilmdBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_11002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11002', $this->edifactObject->getDescription('name'));
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
    )
    {
        return m::mock(\StdClass::class);
    }
}
