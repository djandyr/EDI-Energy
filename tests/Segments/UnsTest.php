<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiEnergy\Segments\Uns;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class UnsTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'UNS';
        $code ='S';

        $seg = Uns::fromAttributes($code);
        
        $this->assertEquals($segName, $seg->name());
        $this->assertEquals($code, $seg->code());
    }
}
