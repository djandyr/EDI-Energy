<?php

namespace Proengeno\EdiEnergy\Mscons\M13006VL;

use Proengeno\EdiEnergy\Edifact;

class MsconsM13006VL extends Edifact
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
        'IMD' => \Proengeno\EdiEnergy\Segments\Imd::class,
        'LOC' => \Proengeno\EdiEnergy\Segments\Loc::class,
        'LIN' => \Proengeno\EdiEnergy\Segments\Lin::class,
        'PIA' => \Proengeno\EdiEnergy\Segments\Pia::class,
        'QTY' => \Proengeno\EdiEnergy\Segments\Qty::class,
        'STS' => \Proengeno\EdiEnergy\Segments\Sts::class,
        'UNS' => \Proengeno\EdiEnergy\Segments\Uns::class,
        'UNT' => \Proengeno\EdiEnergy\Segments\Unt::class,
        'UNZ' => \Proengeno\EdiEnergy\Segments\Unz::class,
    ];

    protected static $blueprint = [
        ['name' => 'UNA'],
        ['name' => 'UNB'],
        ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'UNH'],
            ['name' => 'BGM', 'templates' => ['docCode' => [7], 'messageCode' => [1]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [137], 'code' => [203]]],
            ['name' => 'RFF', 'templates' => ['code' => ['ACW']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['13006']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS']]],
            ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'O', 'segments' => [
                ['name' => 'CTA', 'necessity' => 'O'],
                ['name' => 'LOOP', 'maxLoops' => 5, 'necessity' => 'O', 'segments' => [
                    ['name' => 'COM'],
                ]],
            ]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MR']]],
            ['name' => 'UNS', 'templates' => ['code' => ['D']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['DP']]],
            ['name' => 'LOC', 'templates' => ['qualifier' => [172]]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ];
}
