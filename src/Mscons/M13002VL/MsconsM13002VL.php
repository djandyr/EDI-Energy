<?php

namespace Proengeno\EdiEnergy\Mscons\M13002VL;

use Proengeno\EdiEnergy\Edifact;

class MsconsM13002VL extends Edifact
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
    
    public function getValidationBlueprint()
    {
        return [
            ['name' => 'UNA'],
            ['name' => 'UNB'],
            ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
                ['name' => 'UNH'],
                ['name' => 'BGM', 'templates' => ['docCode' => [7, 9]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => [137], 'code' => [203]]],
                ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['AGI']]],
                ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['13002']]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
                ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'O', 'segments' => [
                    ['name' => 'CTA', 'necessity' => 'O'],
                    ['name' => 'LOOP', 'maxLoops' => 5, 'necessity' => 'O', 'segments' => [
                        ['name' => 'COM'],
                    ]],
                ]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
                ['name' => 'UNS', 'templates' => ['code' => ['D']]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['DP']]],
                ['name' => 'LOC', 'templates' => ['qualifier' => [172]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => [9], 'code' => [102]]],
                ['name' => 'RFF', 'templates' => ['code' => ['MG']]],
                ['name' => 'CCI', 'templates' => ['type' => ['ACH'], 'code' => ['COM', 'IOM', 'ROM', 'COS', 'COB', 'CMP', 'PMR', 'COT']]],
                ['name' => 'CCI', 'templates' => ['type' => [16], 'code' => ['SMV', 'EMV', 'MRV']]],
                ['name' => 'LIN'],
                ['name' => 'PIA', 'templates' => ['number' => [5], 'articleCode' => ['SRW']]],
                ['name' => 'QTY', 'templates' => ['qualifier' => [220, 67, 201, 20]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => [163], 'code' => [102]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => [164], 'code' => [102]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => [9], 'code' => [102]]],
                ['name' => 'STS', 'necessity' => 'O'],
                ['name' => 'UNT'],
            ]],
            ['name' => 'UNZ']
        ];
    }
}
