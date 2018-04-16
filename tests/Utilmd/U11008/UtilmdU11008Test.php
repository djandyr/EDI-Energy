<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11008;

use DateTime;
use Mockery as m;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Utilmd\U11008\UtilmdU11008Builder;
use Proengeno\EdiEnergy\Test\Utilmd\DescriptionAssertionTrait;
use Proengeno\EdiEnergy\Interfaces\Utilmd\Supplier\GridOperaterClosureResponseInterface;

class UtilmdU11008Test extends TestCase
{
    use DescriptionAssertionTrait;

    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11008Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_11008_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11008', $this->edifactObject->getDescription('name'));
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
        $signOffDate = '2016-01-01';
        $balancingEndDate = '2015-12-31';
        $meterpoint = '12345678901';
        $answer = 'E15';
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock($signOffDate, $balancingEndDate, $meterpoint, $answer)]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->assertEquals($signOffDate, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '93';
        })->date()->format('Y-m-d'));
        $this->assertEquals($balancingEndDate, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '159';
        })->date()->format('Y-m-d'));
        $this->assertEquals($meterpoint, $this->edifactObject->findSegmentFromBeginn('LOC', function($s) {
            return $s->qualifier() == '172';
        })->number());
        $this->assertEquals($answer, $this->edifactObject->findSegmentFromBeginn('STS', function($s) {
            return $s->category() == 'E01';
        })->reason());
    }

    private function makeUtilmdMock(
        $signOffDate,
        $balancingEndDate,
        $meterpoint,
        $answer = 'E15',
        $ideRef = 'IDE_REF',
        $requestRef = 'REQ_REF',
        $comments = null
    )
    {
        return m::mock(GridOperaterClosureResponseInterface::class)
             ->shouldReceive('getIdeRef')->andReturn($ideRef)
             ->shouldReceive('getRequestRef')->andReturn($ideRef)
             ->shouldReceive('getSignOffDate')->andReturn(new DateTime($signOffDate))
             ->shouldReceive('getBalancingEnd')->andReturn(new DateTime($balancingEndDate))
             ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
             ->shouldReceive('getComments')->andReturn($comments)
             ->shouldReceive('getAnswer')->andReturn($answer)
             ->shouldReceive('getComments')->andReturn($comments)
             ->getMock();
    }
}
