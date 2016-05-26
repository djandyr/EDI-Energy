<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiMessages\Segments\Imd;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class ImdTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'CCI';
        $code = 'ABC';
        $qualifier = '12345678901234567';

        $seg = Imd::fromAttributes($code, $qualifier);
        
        $this->assertEquals($code, $seg->code());
        $this->assertEquals($qualifier, $seg->qualifier());
    }
}
