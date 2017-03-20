<?php

namespace Proengeno\EdiEnergy\Test\Utilmd\U11004;

use DateTime;
use Mockery as m;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Configuration;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Utilmd\U11004\UtilmdU11004Builder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierGridOperationCancellationInterface;

class UtilmdU11004Test extends TestCase
{
    private $utilmdBuilder;

    protected function setUp()
    {
        parent::setUp();
        $this->utilmdBuilder = new UtilmdU11004Builder('to', tempnam(sys_get_temp_dir(), 'EdifactTest'), $this->configuration);
    }

    /** @test */
    public function it_build_up_the_Message_instance_with_utilmd_13002_mapping()
    {
        $this->assertInstanceOf(Message::class, $this->edifactObject = $this->utilmdBuilder->get());
        $this->assertEquals('UtilmdU11004', $this->edifactObject->getDescription('name'));
    }

    /** @test */
    public function it_creates_a_valid_default_message()
    {
        $cancellationDate = '2016-01-01';

        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock('E03', $cancellationDate)]);
        $this->edifactObject = $this->utilmdBuilder->get();
        $this->edifactObject->validate();
        $this->assertEquals(null, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '92';
        }));
        $this->assertEquals($cancellationDate, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '93';
        })->date()->format('Y-m-d'));

    }

    /** @test */
    public function it_creates_a_valid_revocation_message()
    {
        $contractStart = '2014-01-01';
        $cancellationDate = null;

        $this->utilmdBuilder->addMessage([$this->makeUtilmdMock('ZG9', $cancellationDate, $contractStart)]);
        $this->edifactObject = $this->utilmdBuilder->get();
        $this->edifactObject->validate();
        $this->assertEquals($contractStart, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '92';
        })->date()->format('Y-m-d'));
        $this->assertEquals(null, $this->edifactObject->findSegmentFromBeginn('DTM', function($s) {
            return $s->qualifier() == '93';
        }));
    }

    private function makeUtilmdMock(
        $reason,
        $cancellationDate,
        $contractStart = null,
        $meterpoint = 'DE12343',
        $ideRef = 'IDE_REF',
        $comments = null
    )
    {
        return m::mock(SupplierGridOperationCancellationInterface::class)
            ->shouldReceive('getIdeRef')->andReturn($ideRef)
            ->shouldReceive('getReason')->andReturn($reason)
            ->shouldReceive('getComments')->andReturn($comments)
            ->shouldReceive('getMeterpoint')->andReturn($meterpoint)
            ->shouldReceive('getContractStart')->andReturn(new DateTime($contractStart))
            ->shouldReceive('getCancellationDate')->andReturn(new DateTime($cancellationDate))
            ->getMock();
    }
}
