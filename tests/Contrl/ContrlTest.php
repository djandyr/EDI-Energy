<?php

namespace Proengeno\EdiEnergy\Test\Contrl;

use DateTime;
use Mockery as m;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Contrl\ContrlBuilder;
use Proengeno\EdiEnergy\Contrl\ContrlPositiv;
use Proengeno\EdiEnergy\Contrl\ContrlFileError;

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
    public function it_creates_a_postiv_contrl()
    {
        $receiver = 'to';
        $unbRef = 'UNB_REF';

        $this->contrlBuilder->addMessage(new ContrlPositiv($receiver, 'UNB_REF'));
        $this->edifactObject = $this->contrlBuilder->get();

        $this->edifactObject->validateSegments();

        $this->assertEquals('electric', $this->edifactObject->getConfiguration('energyType'));
        $this->assertEquals($receiver, $this->edifactObject->findSegmentFromBeginn('UCI')->sender());
        $this->assertEquals($unbRef, $this->edifactObject->getCurrentSegment()->unbRef());
        $this->assertEquals($this->configuration->getExportSender(), $this->edifactObject->getCurrentSegment()->receiver());
    }

    /** @test */
    public function it_creates_a_file_error_contrl()
    {
        $receiver = 'to';
        $unbRef = 'UNB_REF';

        $this->contrlBuilder->addMessage(new ContrlFileError($receiver, 'UNB_REF', ContrlFileError::INVALID_RECEIVER));
        $this->edifactObject = $this->contrlBuilder->get();

        $this->edifactObject->validateSegments();

        $this->assertEquals('electric', $this->edifactObject->getConfiguration('energyType'));
        $this->assertEquals($receiver, $this->edifactObject->findSegmentFromBeginn('UCI')->sender());
        $this->assertEquals($unbRef, $this->edifactObject->getCurrentSegment()->unbRef());
        $this->assertEquals($this->configuration->getExportSender(), $this->edifactObject->getCurrentSegment()->receiver());
    }
}
