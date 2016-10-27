<?php

namespace Proengeno\EdiEnergy\Orders\O17103;

use Proengeno\EdiEnergy\Edifact;

class OrdersO17103 extends Edifact
{
    protected static $blueprint = [
        ['name' => 'UNA'],
        ['name' => 'UNB'],
        ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'UNH'],
            ['name' => 'BGM', 'templates' => ['docCode' => [7]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [137], 'code' => [102]]],
            ['name' => 'IMD', 'templates' => ['code' => ['Z10', 'Z14', 'Z07']]],
            ['name' => 'IMD', 'templates' => ['code' => ['Z10', 'Z14', 'Z07']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['17102', '17103']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
            ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
                ['name' => 'CTA', 'necessity' => 'R'],
                ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
                    ['name' => 'COM', 'necessity' => 'R']
                ]],
            ]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['DP']]],
            ['name' => 'LOC', 'templates' => ['qualifier' => [172]]],
            ['name' => 'LIN'],
            ['name' => 'DTM', 'templates' => ['qualifier' => [163], 'code' => [303]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [164], 'code' => [303]]],
            ['name' => 'UNS', 'templates' => ['code' => ['S']]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ];
}
