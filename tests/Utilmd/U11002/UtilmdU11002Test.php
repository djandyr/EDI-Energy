<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11002;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11002\UtilmdU11002Builder;
use Proengeno\EdiEnergy\Configuration;

class UtilmdU11002Test extends TestCase
{
    private $utilmdBuilder;
    private $edifactObject;

    public function setUp()
    {
        $configuration = new Configuration;
        $configuration->setExportSender('from');
        $this->utilmdBuilder = new UtilmdU11002Builder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $configuration);
    }

    public function tearDown()
    {
        if ($this->edifactObject) {
            @unlink($this->edifactObject->getFilepath());
        }
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(UtilmdU11002Builder::class, $this->utilmdBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_mscons_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11002', $this->edifactObject->getAdapterName());
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
