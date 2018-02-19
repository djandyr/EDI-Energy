<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11016;

use DateTime;
use Mockery as m;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Utilmd\U11016\UtilmdU11016Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\Supplier\SupllierSignOffInterface;

class UtilmdU11016Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11016Builder('to', $this->configuration, tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11016', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_creates_a_valid_fixed_sign_off_message()
    {
        $cancellationDate = '2016-01-01';
        $fixedSignOff = true;
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock($cancellationDate, $fixedSignOff)]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->edifactObject->validate();
        $this->assertEquals(null, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '471';
        }));
        $this->assertEquals($cancellationDate, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '93';
        })->date()->format('Y-m-d'));

    }

    /** @test */
    public function it_creates_a_valid_open_sign_off_message()
    {
        $cancellationDate = '2016-01-01';
        $fixedSignOff = false;
        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock($cancellationDate, $fixedSignOff)]);
        $this->edifactObject = $this->utilmdBuilder->get();

        $this->edifactObject->validate();

        $this->assertEquals($cancellationDate, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '471';
        })->date()->format('Y-m-d'));
        $this->assertEquals(null, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '93';
        }));

    }

    // private function makeFixedSignOffUtilmd()
    // {
    //     $cancellationDate,
    //     $meterNumber = 'meter-no-123456',
    //     $meterpoint = 'DE12343',
    //     $ideRef = 'IDE_REF',
    //     $comments = null
    // }

    private function makeUtilmdMock(
        $cancellationDate,
        $fixedSignOff,
        $meterNumber = 'meter-no-123456',
        $ideRef = 'IDE_REF',
        $meterpoint = null,
        $comments = null
    )
    {
        return m::mock(SupllierSignOffInterface::class)
             ->shouldReceive('getIdeRef')->andReturn($ideRef)
             ->shouldReceive('getComments')->andReturn($comments)
             ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
             ->shouldReceive('getMeterNumber')->andReturn($meterNumber)
             ->shouldReceive('getFirstName')->andReturn('FristName')
             ->shouldReceive('getLastName')->andReturn('LastName')
             ->shouldReceive('getCompany')->andReturn(null)
             ->shouldReceive('getStreet')->andReturn('TestStreet')
             ->shouldReceive('getStreetNumber')->andReturn(26)
             ->shouldReceive('getCity')->andReturn('TestCity')
             ->shouldReceive('getZip')->andReturn(26844)
             ->shouldReceive('getSignOffDate')->andReturn(new DateTime($cancellationDate))
             ->shouldReceive('isFixedSignOff')->andReturn($fixedSignOff)
             ->getMock();
    }
}
