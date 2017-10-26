<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11024;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Utilmd\U11024\UtilmdU11024Builder;

class UtilmdU11024Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11024Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'));
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11024', $this->edifactObject->getDescription('name'));
    }

    private function makeUtilmdMock(
    )
    {
        return m::mock(\StdClass::class);
    }
}
