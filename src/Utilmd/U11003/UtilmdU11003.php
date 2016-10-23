<?php

namespace Proengeno\EdiEnergy\Utilmd\U11003;

use Proengeno\EdiEnergy\Edifact;

class UtilmdU11003 extends Edifact
{
    protected static $segments = [
        'UNA' => \Proengeno\EdiEnergy\Segments\Una::class,
        'UNB' => \Proengeno\EdiEnergy\Segments\Unb::class,
        'UNH' => \Proengeno\EdiEnergy\Segments\Unh::class,
        'BGM' => \Proengeno\EdiEnergy\Segments\Bgm::class,
        'DTM' => \Proengeno\EdiEnergy\Segments\Dtm::class,
        'RFF' => \Proengeno\EdiEnergy\Segments\Rff::class,
        'NAD' => \Proengeno\EdiEnergy\Segments\Nad::class,
        'CTA' => \Proengeno\EdiEnergy\Segments\Cta::class,
        'COM' => \Proengeno\EdiEnergy\Segments\Com::class,
        'CCI' => \Proengeno\EdiEnergy\Segments\Cci::class,
        'CAV' => \Proengeno\EdiEnergy\Segments\Cav::class,
        'IDE' => \Proengeno\EdiEnergy\Segments\Ide::class,
        'FTX' => \Proengeno\EdiEnergy\Segments\Ftx::class,
        'IMD' => \Proengeno\EdiEnergy\Segments\Imd::class,
        'STS' => \Proengeno\EdiEnergy\Segments\Sts::class,
        'AGR' => \Proengeno\EdiEnergy\Segments\Agr::class,
        'SEQ' => \Proengeno\EdiEnergy\Segments\Seq::class,
        'QTY' => \Proengeno\EdiEnergy\Segments\Qty::class,
        'PIA' => \Proengeno\EdiEnergy\Segments\Pia::class,
        'LOC' => \Proengeno\EdiEnergy\Segments\Loc::class,
        'UNS' => \Proengeno\EdiEnergy\Segments\Uns::class,
        'UNT' => \Proengeno\EdiEnergy\Segments\Unt::class,
        'UNZ' => \Proengeno\EdiEnergy\Segments\Unz::class,
    ];

    protected static $blueprint = [
        ['name' => 'UNA'],
        ['name' => 'UNB'],
        ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'UNH'],
            ['name' => 'BGM', 'templates' => ['docCode' => ['E01']]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [137], 'code' => [203]]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
            ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'O', 'segments' => [
                ['name' => 'CTA', 'necessity' => 'O'],
                ['name' => 'LOOP', 'maxLoops' => 5, 'necessity' => 'O', 'segments' => [
                    ['name' => 'COM'],
                ]],
            ]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
            ['name' => 'IDE', 'templates' => ['qualifier' => ['24']]],
            ['name' => 'IMD', 'templates' => ['code' => ['Z14'], 'qualifier' => ['Z07', 'Z08']]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z07'], 'code' => [102]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z08'], 'code' => [102]]],
            ['name' => 'STS', 'templates' => ['category' => [7]]],
            ['name' => 'STS', 'necessity' => 'O', 'templates' => ['category' => ['Z17']]],
            ['name' => 'STS', 'templates' => ['category' => ['E01']]],
            ['name' => 'FTX', 'necessity' => 'O'],
            ['name' => 'LOC', 'templates' => ['qualifier' => ['172']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11003']]],
            ['name' => 'RFF', 'templates' => ['code' => ['TN']]],
            ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['Z07']]],
            ['name' => 'NAD', 'necessity' => 'O', 'templates' => ['qualifier' => ['VY']]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ];
}
