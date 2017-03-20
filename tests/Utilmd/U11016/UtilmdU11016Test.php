<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11003;

use DateTime;
use Mockery as m;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Utilmd\U11016\UtilmdU11016Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierSupllierSigningOffInterface;

class UtilmdU11016Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11016Builder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11016', $this->edifactObject->getDescription('name'));
    }

    // /** @test */
    // public function it_creates_a_valid_default_message()
    // {
    //     $cancellationDate = '2016-01-01';

    //     $this->utilmdBuilder->addMessage([$this->makeUtilmdMock($cancellationDate, true)]);
    //     $this->edifactObject = $this->utilmdBuilder->get();
    //     $this->edifactObject->validate();
    //     $this->assertEquals(null, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
    //         return $s->qualifier() == '92';
    //     }));
    //     $this->assertEquals($cancellationDate, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
    //         return $s->qualifier() == '93';
    //     })->date()->format('Y-m-d'));

    // }

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
        $meterpoint = 'DE12343',
        $ideRef = 'IDE_REF',
        $comments = null
    )
    {
        return m::mock(SupplierSupllierSigningOffInterface::class)
             ->shouldReceive('getIdeRef')->andReturn($ideRef)
             ->shouldReceive('getComments')->andReturn($comments)
             ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
             ->shouldReceive('getMeterNumber')->andReturn($meterNumber)
             ->shouldReceive('getFirstName')->andReturn('FristName')
             ->shouldReceive('getLastName')->andReturn('LastName')
             ->shouldReceive('getCompany')->andReturn('compny')
             ->shouldReceive('getStreet')->andReturn('TestStreet')
             ->shouldReceive('getStreetNumber')->andReturn(26)
             ->shouldReceive('getCity')->andReturn('TestCity')
             ->shouldReceive('getZip')->andReturn(26844)
             ->shouldReceive('getSignOffDate')->andReturn(new DateTime($cancellationDate))
             ->shouldReceive('isFixedSignOff')->andReturn($fixedSignOff)
             ->getMock();
    }
}
