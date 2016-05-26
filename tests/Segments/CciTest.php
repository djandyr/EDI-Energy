<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiMessages\Segments\Cci;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class CciTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'CCI';
        $type = 'CBA';
        $code = '12345678901234567';

        $seg = Cci::fromAttributes($type, $code);
        
        $this->assertEquals($segName, $seg->name());
        $this->assertEquals($type, $seg->type());
        $this->assertEquals($code, $seg->code());
    }
}
