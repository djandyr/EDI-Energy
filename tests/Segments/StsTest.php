<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiEnergy\Segments\Sts;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class StsTest extends TestCase
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'STS';
        $category = 7;
        $reason = 'Z26';

        $seg = Sts::fromAttributes($category, $reason);

        $this->assertEquals($category, $seg->category());
        $this->assertEquals($reason, $seg->reason());
    }

    /** @test */
    public function it_can_parse_the_json_information()
    {
        //$this->assertEquals('Information über existierende Zuordnung', Sts::meta()->description('reason', 'Z26'));
    }
}
