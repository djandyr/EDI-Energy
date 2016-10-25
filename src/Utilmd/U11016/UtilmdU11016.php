<?php

namespace Proengeno\EdiEnergy\Utilmd\U11016;

use Proengeno\EdiEnergy\Edifact;

class UtilmdU11016 extends Edifact
{
    protected static $segments = [
        'UNA' => \Proengeno\EdiEnergy\Segments\Una::class,
        'UNB' => \Proengeno\EdiEnergy\Segments\Unb::class,
        'UNH' => \Proengeno\EdiEnergy\Segments\Unh::class,
        'BGM' => \Proengeno\EdiEnergy\Segments\Bgm::class,
        'DTM' => \Proengeno\EdiEnergy\Segments\Dtm::class,
        'NAD' => \Proengeno\EdiEnergy\Segments\Nad::class,
        'CTA' => \Proengeno\EdiEnergy\Segments\Cta::class,
        'COM' => \Proengeno\EdiEnergy\Segments\Com::class,
        'IDE' => \Proengeno\EdiEnergy\Segments\Ide::class,
        'IMD' => \Proengeno\EdiEnergy\Segments\Imd::class,
        'STS' => \Proengeno\EdiEnergy\Segments\Sts::class,
        'FTX' => \Proengeno\EdiEnergy\Segments\Ftx::class,
        'LOC' => \Proengeno\EdiEnergy\Segments\Loc::class,
        'RFF' => \Proengeno\EdiEnergy\Segments\Rff::class,
        'SEQ' => \Proengeno\EdiEnergy\Segments\Seq::class,
        'QTY' => \Proengeno\EdiEnergy\Segments\Qty::class,
        'CCI' => \Proengeno\EdiEnergy\Segments\Cci::class,
        'CAV' => \Proengeno\EdiEnergy\Segments\Cav::class,
        'UNT' => \Proengeno\EdiEnergy\Segments\Unt::class,
        'UNZ' => \Proengeno\EdiEnergy\Segments\Unz::class,
    ];

    protected static $blueprint = [
        ['name' => 'UNA'],
        ['name' => 'UNB'],
        ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'UNH'],
            ['name' => 'BGM', 'templates' => ['docCode' => ['E35']]],
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
            ['name' => 'IMD', 'templates' => ['code' => ['Z14'], 'qualifier' => ['Z07']]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['93'], 'code' => [102]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['471'], 'code' => [102]]],
            ['name' => 'STS', 'templates' => ['category' => [7], 'reason' => ['E03']]],
            ['name' => 'STS', 'templates' => ['category' => ['E01']]],
            ['name' => 'LOC', 'templates' => ['qualifier' => ['172']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11016']]],
            ['name' => 'SEQ', 'templates' => ['code' => ['Z01']]],
            ['name' => 'QTY', 'templates' => ['qualifier' => ['Z09']]],
            ['name' => 'SEQ', 'necessity' => 'O', 'templates' => ['code' => ['Z03']]],
            ['name' => 'CCI', 'necessity' => 'O', 'templates' => ['code' => ['E13']]],
            ['name' => 'CAV', 'necessity' => 'O', 'templates' => ['code' => ['Z30']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['UD']]],
            ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['Z01']]],
            ['name' => 'NAD', 'necessity' => 'O', 'templates' => ['qualifier' => ['DP']]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ];
}
