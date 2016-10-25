<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11003;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11017\UtilmdU11017Builder;

class UtilmdU11017Test extends TestCase
{
    private $utilmdBuilder;
    private $edifactObject;

    public function setUp()
    {
        $this->utilmdBuilder = new UtilmdU11017Builder('from', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
    }

    public function tearDown()
    {
        if ($this->edifactObject) {
            @unlink($this->edifactObject->getFilepath());
        }
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11017', $this->edifactObject->getAdapterName());
    }

    private function makeUtilmdMock(
    )
    {
        return m::mock(\StdClass::class);
    }
}