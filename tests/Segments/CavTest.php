<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiEnergy\Segments\Cav;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class CavTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'CAV';
        $code = 'ABC';
        $responsCode = 'CBA';
        $value = '12345678901234567890123456789012345';

        $seg = Cav::fromAttributes($code, $responsCode , $value);
        
        $this->assertEquals($segName, $seg->name());
        $this->assertEquals($code, $seg->code());
        $this->assertEquals($responsCode, $seg->responsCode());
        $this->assertEquals($value, $seg->value());
    }
}
