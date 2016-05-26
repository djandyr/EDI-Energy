<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiMessages\Segments\Loc;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class LocTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'CCI';
        $qualifier = 'ABC';
        $number = '12345678901234567890123456789012345';

        $seg = Loc::fromAttributes($qualifier, $number);
        
        $this->assertEquals($qualifier, $seg->qualifier());
        $this->assertEquals($number, $seg->number());
    }
}
