<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiEnergy\Segments\Unz;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class UnzTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'UNZ';
        $counter = 3;
        $referenz ='S';

        $seg = Unz::fromAttributes($counter, $referenz);
        
        $this->assertEquals($counter, $seg->counter());
        $this->assertEquals($referenz, $seg->referenz());
    }
}
