<?php

namespace Proengeno\EdiMessages\Test\Remadv33001;

use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\EdiMessages\Remadv\R33001\RemadvR33001;
use Proengeno\EdiMessages\Remadv\R33001\RemadvR33001Builder;

class Remadv33001Test extends TestCase 
{
    /** @test */
    public function it_uses_RemadvR33001Builder_to_build_itself()
    {
        $builder = RemadvR33001::build('from', 'to', tempnam(sys_get_temp_dir(), 'EdifactTest'));
        $this->assertInstanceOf(RemadvR33001Builder::class, $builder);
    }
}
