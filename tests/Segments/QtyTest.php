<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use Proengeno\EdiEnergy\Segments\Qty;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;

class QtyTest extends TestCase
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'QTY';
        $qualifier = 'ABC';
        $amount = '1234567890123456789012345678901234A';
        $unitCode = '1234567A';

        $seg = Qty::fromAttributes($qualifier, $amount, $unitCode);

        $this->assertEquals($qualifier, $seg->qualifier());
        $this->assertEquals($amount, $seg->amount());
        $this->assertEquals($unitCode, $seg->unitCode());
    }

    /** @test */
    public function it_can_fetch_zero_amount_correctly()
    {
        $segName = 'QTY';
        $qualifier = 'ABC';
        $amount = 0;
        $unitCode = '1234567A';

        $seg = Qty::fromAttributes($qualifier, $amount, $unitCode);
        $this->assertEquals($qualifier, $seg->qualifier());
        $this->assertSame('0', $seg->amount());
        $this->assertEquals($unitCode, $seg->unitCode());
    }
}
