<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiMessages\Segments\Ide;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class IdeTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'CCI';
        $qualifier = 'ABC';
        $idNumber = '12345678901234567890123456789012345';

        $seg = Ide::fromAttributes($qualifier, $idNumber);
        
        $this->assertEquals($qualifier, $seg->qualifier());
        $this->assertEquals($idNumber, $seg->idNumber());
    }
}
