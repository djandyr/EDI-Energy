<?php

namespace Proengeno\Edifact\Test\Message\Segments;

use DateTime;
use Proengeno\EdiEnergy\Segments\Dtm;
use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\Edifact\Message\Delimiter;
use Proengeno\Edifact\Exceptions\SegValidationException;

class DtmTest extends TestCase 
{
    /** @test */
    public function it_can_set_and_fetch_basic_informations()
    {
        $code = 102;
        $segName = 'DTM';
        $qualifier = '137';
        $date = new DateTime;
        $checkDateformat = 'Y-m-d 00:00:00';

        $seg = $this->getDtm($date, $code, $qualifier);
        $this->assertEquals($segName, $seg->name());
        $this->assertEquals($qualifier, $seg->qualifier());
        $this->assertEquals($date->format($checkDateformat), $seg->date()->format('Y-m-d H:i:s'));
        $this->assertEquals($code, $seg->code());
    }

    /** @test */
    public function it_can_set_and_fetch_date_with_code_102()
    {
        $code = 102;
        $date = new DateTime;
        $checkDateformat = 'Y-m-d 00:00:00';

        $seg = $this->getDtm($date, $code);
        $this->assertEquals($date->format($checkDateformat), $seg->date()->format('Y-m-d H:i:s'));
    }

    /** @test */
    public function it_can_set_and_fetch_date_with_code_203()
    {
        $code = 203;
        $date = new DateTime;
        $checkDateformat = 'Y-m-d H:i:00';

        $seg = $this->getDtm($date, $code);
        $this->assertEquals($date->format($checkDateformat), $seg->date()->format('Y-m-d H:i:s'));
    }

    /** @test */
    public function it_can_set_and_fetch_date_with_code_303()
    {
        $code = 303;
        $date = new DateTime;
        $checkDateformat = 'Y-m-d H:i:00';

        $seg = $this->getDtm($date, $code);
        $this->assertEquals($date->format($checkDateformat), $seg->date()->format('Y-m-d H:i:s'));
    }

    /** @test */
    public function it_can_set_and_fetch_date_with_code_610()
    {
        $code = 610;
        $date = new DateTime;
        $checkDateformat = 'Y-m-d H:00:00';

        $seg = $this->getDtm($date, $code);
        $this->assertEquals( $date->format($checkDateformat), $seg->date()->format('Y-m-d H:i:s'));
    }

    /** @test */
    public function it_throw_an_exception_if_the_date_code_is_unknown()
    {
        $code = 999;
        $date = new DateTime;
        
        $this->expectException(SegValidationException::class);
        $seg = $this->getDtm($date, $code);
    }

    private function getDtm($date, $code, $qualifier = '137')
    {
        return Dtm::fromAttributes($qualifier, $date, $code);
    }
}
