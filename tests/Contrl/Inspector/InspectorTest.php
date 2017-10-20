<?php

namespace Proengeno\EdiEnergy\Test\Contrl\Inspector;

use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Contrl\ContrlPositiv;
use Proengeno\EdiEnergy\Contrl\ContrlFileError;
use Proengeno\EdiEnergy\Contrl\Inspector\Inspector;

class InspectorTest extends TestCase
{
    /** @test */
    public function it_inspects_from_string()
    {
        $inspector = Inspector::fromString("UNB+UNOC:3+9900635000006:500+from:500+170927:0800+00000000114655", $this->configuration);
        $this->assertInstanceOf(ContrlPositiv::class, $inspector->getContrlItem());
    }

    /** @test */
    public function it_checks_an_edifact_message_with_postiv_contrl()
    {
        $edifactMessage = Message::fromString(
            "UNB+UNOC:3+9900635000006:500+from:500+170927:0800+00000000114655",
            $this->configuration
        );

        $inspector = new Inspector($edifactMessage);
        $this->assertInstanceOf(ContrlPositiv::class, $inspector->getContrlItem());
    }

    /** @test */
    public function it_checks_an_edifact_message_with_negative_contrl_cause_wrong_receiver()
    {
        $receier = 'wrongReceiver';
        $edifactMessage = Message::fromString(
            "UNB+UNOC:3+9900635000006:500+$receier:500+170927:0800+00000000114655",
            $this->configuration
        );

        $contrl = (new Inspector($edifactMessage))->getContrlItem();
        $this->assertInstanceOf(ContrlFileError::class, $contrl);
        $this->assertEquals($contrl::INVALID_RECEIVER, $contrl->getUciCode());
        $this->assertEquals('UNB', $contrl->getServiceSegement());
    }
}
