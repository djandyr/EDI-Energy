<?php

namespace Proengeno\EdiEnergy\Utilmd\U11002;

use Proengeno\EdiEnergy\Edifact;

class UtilmdU11002 extends Edifact
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

    public function getValidationBlueprint()
    {
        return [
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
                ['name' => 'DTM', 'templates' => ['qualifier' => [92], 'code' => [102]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => [158], 'code' => [102]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => ['752'], 'code' => [106]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => ['Z09'], 'code' => [602]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => ['672'], 'code' => [802]]],
                ['name' => 'STS', 'templates' => ['category' => [7], 'reason' => ['E01']]],
                ['name' => 'STS', 'templates' => ['category' => ['E01'], 'reason' => ['Z43']]],
                ['name' => 'AGR', 'templates' => ['qualifier' => [11], 'type' => ['E02']]],
                ['name' => 'AGR', 'templates' => ['qualifier' => ['E03'], 'type' => ['E10']]],
                ['name' => 'LOC', 'templates' => ['qualifier' => ['107']]],
                ['name' => 'LOC', 'templates' => ['qualifier' => ['237']]],
                ['name' => 'LOC', 'templates' => ['qualifier' => ['172']]],
                ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11002']]],
                ['name' => 'RFF', 'templates' => ['code' => ['TN'], 'referenz' => ['UE01-26823-166A4DDC4FA']]],
            ]],
            ['name' => 'UNZ']
        ];
    }
}
