<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiMessages\Segments\Moa;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class MoaTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'MOA';
        $qualifier = '380';
        $amount = '1000';

        $seg = Moa::fromAttributes($qualifier, $amount);
        
        $this->assertEquals($qualifier, $seg->qualifier());
        $this->assertEquals($amount, $seg->amount());
    }

    /** @test */
    public function it_set_the_decimal_places_on_two()
    {
        $segName = 'MOA';
        $qualifier = '380';
        $amount = 10.0;

        $seg = Moa::fromAttributes($qualifier, $amount);
        $this->assertEquals(2, strlen(substr(strrchr($seg->amount(), "."), 1)));
    }
}
