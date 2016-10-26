<?php

namespace Proengeno\EdiEnergy\Test\Remadv33001;

use Proengeno\EdiEnergy\Test\TestCase;
use Proengeno\EdiEnergy\Remadv\R33001\RemadvR33001;
use Proengeno\EdiEnergy\Configuration;

class Remadv33001Test extends TestCase
{
    /** @test */
    public function it_converts_the_charset()
    {
        $utf8String = 'ß';
        $isoString = iconv('UTF-8', 'CP1252', $utf8String);

        $configuration = new Configuration;
        $configuration->setOutputCharsetConverter(function($string) {
            $encoding = mb_detect_encoding($string, 'UTF-8, CP1252, ISO-8859-1');
            if ($encoding && $connvertedString = iconv($encoding, 'UTF-8', $string)) {
                return $connvertedString;
            }
            return $string;
        });

        $remadv = RemadvR33001::fromString("UNH+O160482A7C2+$isoString:D:09B:UN:1.1e'RFF+Z13:17103'", $configuration);
        $this->assertEquals($utf8String, $remadv->findNextSegment("UNH")->type());
    }
}
