<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiMessages\Segments\Agr;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class AgrTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $seg = Agr::fromAttributes('ABC', 'CBA', new Delimiter);
        
        $this->assertEquals('AGR', $seg->name());
        $this->assertEquals('ABC', $seg->qualifier());
        $this->assertEquals('CBA', $seg->type());
    }
}
