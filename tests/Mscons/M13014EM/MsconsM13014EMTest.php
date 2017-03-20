<?php

namespace Proengeno\EdiEnergy\Test\Mscons\M13014EM;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Interfaces\MsconsVlInterface;
use Proengeno\EdiEnergy\Mscons\M13014EM\MsconsM13014EMBuilder;

class MsconsM13014EMTest extends TestCase
{
    private $msconsBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->msconsBuilder = new MsconsM13014EMBuilder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(MsconsM13014EMBuilder::class, $this->msconsBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->msconsBuilder->get());
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_mscons_13014_VL_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->msconsBuilder->get());
        $this->assertEquals('MsconsM13014EM', $this->edifactObject->getDescription('name'));
    }
}
