<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use DateTime;
use Proengeno\EdiMessages\Segments\Dtm;
use Proengeno\EdiMessages\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;
use Proengeno\Edifact\Exceptions\SegValidationException;

class DtmTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $segName = 'DTM';
        $qualifier = '137';
        $date = new DateTime;
        $code = 102;

        $seg = Dtm::fromAttributes($qualifier, $date, $code);
        $this->assertEquals($qualifier, $seg->qualifier());
        $this->assertEquals($date->format('Y-m-d'), $seg->date()->format('Y-m-d'));
        $this->assertEquals($code, $seg->code());
    }

    /** @test */
    public function it_can_parse_date_format_that_not_supported_by_php()
    {
        $segName = 'DTM';
        $qualifier = '137';
        $date = new DateTime;
        $code = 303;

        $seg = Dtm::fromAttributes($qualifier, $date, $code);
        $this->assertEquals($qualifier, $seg->qualifier());
        $this->assertEquals( $date->format('Y-m-d'), $seg->date()->format('Y-m-d'));
        $this->assertEquals($code, $seg->code());
    }

    /** @test */
    public function it_throw_an_exception_if_the_date_code_is_unknown()
    {
        $segName = 'DTM';
        $qualifier = '137';
        $date = new DateTime;
        $code = 999;
        
        $this->expectException(SegValidationException::class);
        $seg = Dtm::fromAttributes($qualifier, $date, $code);
    }
}
