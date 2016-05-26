<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiMessages\Segments\Cta;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class CtaTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'CTA';
        $type = 'ABC';
        $employee = 'Dr. Hofstaetter';

        $seg = Cta::fromAttributes($type, $employee);
        $this->assertEquals($segName, $seg->name());
        $this->assertEquals($type, $seg->type());
        $this->assertEquals($employee, $seg->employee());
    }
}
