<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiEnergy\Segments\Unt;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class UntTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'UNT';
        $segCount = 3;
        $referenz ='S';

        $seg = Unt::fromAttributes($segCount, $referenz);
        
        $this->assertEquals($segCount, $seg->segCount());
        $this->assertEquals($referenz, $seg->referenz());
    }
}
