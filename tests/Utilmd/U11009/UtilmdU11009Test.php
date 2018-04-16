<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11009;

use DateTime;
use Mockery as m;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Utilmd\U11009\UtilmdU11009Builder;
use Proengeno\EdiEnergy\Test\Utilmd\DescriptionAssertionTrait;
use Proengeno\EdiEnergy\Interfaces\Utilmd\Supplier\GridOperaterClosureResponseInterface;

class UtilmdU11009Test extends TestCase
{
    use DescriptionAssertionTrait;

    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11009Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_11009_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11009', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_build_up_the_Message_with_the_decription_values()
    {
        $signOffDate = '2016-01-01';
        $balancingEndDate = '2015-12-31';
        $meterpoint = '12345678901';
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock($signOffDate, $balancingEndDate, $meterpoint)]);

        $this->assertDescriptions($this->utilmdBuilder->get());
    }

    /** @test */
    public function it_creates_a_valid_accepted_closure_response()
    {
        $meterpoint = '12345678901';
        $answer = 'E14';
        $comment = 'TEST COMMENT';
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock(
            $meterpoint, $answer, $comment
        )]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->assertEquals($comment, $this->edifactObject->findSegmentFromBeginn('FTX')->message());
        $this->assertEquals($meterpoint, $this->edifactObject->findSegmentFromBeginn('LOC')->number());
        $this->assertEquals($answer, $this->edifactObject->findSegmentFromBeginn('STS', function($s) {
            return $s->category() == 'E01';
        })->reason());
    }

    private function makeUtilmdMock(
        $meterpoint,
        $answer = 'E15',
        $comments = null,
        $ideRef = 'IDE_REF',
        $requestRef = 'REQ_REF'
    )
    {
        return m::mock(GridOperaterClosureResponseInterface::class)
             ->shouldReceive('getIdeRef')->andReturn($ideRef)
             ->shouldReceive('getRequestRef')->andReturn($ideRef)
             ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
             ->shouldReceive('getComments')->andReturn($comments)
             ->shouldReceive('getAnswer')->andReturn($answer)
             ->shouldReceive('getComments')->andReturn($comments)
             ->getMock();
    }
}
