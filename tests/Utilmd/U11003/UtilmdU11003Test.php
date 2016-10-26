<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11003;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11003\UtilmdU11003Builder;

class UtilmdU11003Test extends TestCase
{
    private $utilmdBuilder;
    private $edifactObject;

    public function setUp()
    {
        $this->utilmdBuilder = new UtilmdU11003Builder('from', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
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
        $this->assertInstanceOf(UtilmdU11003Builder::class, $this->utilmdBuilder);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11003', $this->edifactObject->getAdapterName());
    }

    /** @test */
    public function it_sets_the_correct_GS1_qualifier()
    {
        $this->utilmdBuilder = new UtilmdU11003Builder('400', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));

        $this->utilmdBuilder->addMessage($this->makeUtilmdMock());
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->assertEquals('14', $this->edifactObject->findNextSegment('UNB')->senderQualifier());
        $this->assertEquals('9', $this->edifactObject->findNextSegment('NAD')->idCode());
    }

    private function makeUtilmdMock(
    )
    {
        return m::mock(\StdClass::class);
    }
}
