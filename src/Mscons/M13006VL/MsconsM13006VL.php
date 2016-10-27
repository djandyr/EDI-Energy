<?php

namespace Proengeno\EdiEnergy\Mscons\M13006VL;

use Proengeno\EdiEnergy\Edifact;

class MsconsM13006VL extends Edifact
{
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
