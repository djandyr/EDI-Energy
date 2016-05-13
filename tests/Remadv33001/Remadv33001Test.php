<?php

namespace Proengeno\EdiMessages\Test\Remadv33001;

use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\EdiMessages\Remadv33001\Remadv33001;
use Proengeno\EdiMessages\Remadv33001\Remadv33001Builder;

class Remadv33001Test extends TestCase 
{
    /** @test */
    public function it_can_instanciate()
    {
        $remadvBuilder = new Remadv33001Builder('from', 'to', 'w+');
        
        $this->assertInstanceOf(Remadv33001Builder::class, $remadvBuilder);
    }
}
