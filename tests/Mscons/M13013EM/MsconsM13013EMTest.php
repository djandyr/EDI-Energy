<?php

namespace Proengeno\EdiEnergy\Test\Mscons\M13013EM;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Interfaces\MsconsVlInterface;
use Proengeno\EdiEnergy\Mscons\M13013EM\MsconsM13013EMBuilder;

class MsconsM13013EMTest extends TestCase
{
    private $msconsBuilder;

    public function setUp()
    {
        parent::setUp();
        $this->msconsBuilder = new MsconsM13013EMBuilder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_instanciate_the_correct_class()
    {
        $this->assertInstanceOf(MsconsM13013EMBuilder::class, $this->msconsBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->msconsBuilder->get());
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_mscons_13013_VL_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->msconsBuilder->get());
        $this->assertEquals('MsconsM13013EM', $this->edifactObject->getDescription('name'));
    }
}
