<?php

namespace Proengeno\EdiMessages\Test;

use Mockery as m;
use Proengeno\Edifact\EdifactRegistrar;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        EdifactRegistrar::addSegement('AGR', \Proengeno\EdiMessages\Segments\Agr::class);
        EdifactRegistrar::addSegement('BGM', \Proengeno\EdiMessages\Segments\Bgm::class);
        EdifactRegistrar::addSegement('CAV', \Proengeno\EdiMessages\Segments\Cav::class);
        EdifactRegistrar::addSegement('CCI', \Proengeno\EdiMessages\Segments\Cci::class);
        EdifactRegistrar::addSegement('COM', \Proengeno\EdiMessages\Segments\Com::class);
        EdifactRegistrar::addSegement('CTA', \Proengeno\EdiMessages\Segments\Cta::class);
        EdifactRegistrar::addSegement('CUX', \Proengeno\EdiMessages\Segments\Cux::class);
        EdifactRegistrar::addSegement('DTM', \Proengeno\EdiMessages\Segments\Dtm::class);
        EdifactRegistrar::addSegement('DOC', \Proengeno\EdiMessages\Segments\Doc::class);
        EdifactRegistrar::addSegement('IDE', \Proengeno\EdiMessages\Segments\Ide::class);
        EdifactRegistrar::addSegement('IMD', \Proengeno\EdiMessages\Segments\Imd::class);
        EdifactRegistrar::addSegement('LIN', \Proengeno\EdiMessages\Segments\Lin::class);
        EdifactRegistrar::addSegement('LOC', \Proengeno\EdiMessages\Segments\Loc::class);
        EdifactRegistrar::addSegement('MOA', \Proengeno\EdiMessages\Segments\Moa::class);
        EdifactRegistrar::addSegement('NAD', \Proengeno\EdiMessages\Segments\Nad::class);
        EdifactRegistrar::addSegement('QTY', \Proengeno\EdiMessages\Segments\Qty::class);
        EdifactRegistrar::addSegement('RFF', \Proengeno\EdiMessages\Segments\Rff::class);
        EdifactRegistrar::addSegement('SEQ', \Proengeno\EdiMessages\Segments\Seq::class);
        EdifactRegistrar::addSegement('UNA', \Proengeno\EdiMessages\Segments\Una::class);
        EdifactRegistrar::addSegement('UNB', \Proengeno\EdiMessages\Segments\Unb::class);
        EdifactRegistrar::addSegement('UNH', \Proengeno\EdiMessages\Segments\Unh::class);
        EdifactRegistrar::addSegement('UNS', \Proengeno\EdiMessages\Segments\Uns::class);
        EdifactRegistrar::addSegement('UNT', \Proengeno\EdiMessages\Segments\Unt::class);
        EdifactRegistrar::addSegement('UNZ', \Proengeno\EdiMessages\Segments\Unz::class);
    }

    protected function tearDown()
    {
        m::close();
    }
}
