<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiEnergy\Segments\Ftx;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class FtxTest extends TestCase 
{
    /** @test */
    public function it_supports_maximal_2560_charecters()
    {
        $segName = 'FTX';
        $qualifier = 'ACB';
        $maxcount = 2560;
        $stringcount = $maxcount + 1;
        
        $message = "";
        $downCounter = $stringcount;
        while ($downCounter --> 0) {
            $message .= "a";
        }
        $seg = Ftx::fromAttributes($qualifier, $message);
        
        $this->assertEquals($segName, $seg->name());
        $this->assertEquals($qualifier, $seg->qualifier());
        $this->assertEquals($maxcount, strlen($seg->message()));
    }

    /** @test */
    public function it_exepts_an_empty_message()
    {
        $segName = 'FTX';
        $qualifier = 'ACB';
        $seg = Ftx::fromAttributes($qualifier, '');
        
        $this->assertEquals(0, strlen($seg->message()));
    }
}
