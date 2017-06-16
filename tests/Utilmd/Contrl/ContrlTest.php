<?php

namespace Proengeno\EdiEnergy\Test\Contrl;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Contrl\ContrlBuilder;
use Proengeno\EdiEnergy\Contrl\ContrlPositiv;

class ContrlTest extends TestCase
{
    private $contrlBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->contrlBuilder = new ContrlBuilder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(ContrlBuilder::class, $this->contrlBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->contrlBuilder->get());
        $this->assertEquals('Contrl', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_creates_a_valid_electric_message()
    {
        $this->contrlBuilder->addMessage(new ContrlPositiv('UNB_REF'));
        $this->edifactObject = $this->contrlBuilder->get();

        $this->edifactObject->validateSegments();

        $this->assertEquals('electric', $this->edifactObject->getConfiguration('energyType'));
    }
}