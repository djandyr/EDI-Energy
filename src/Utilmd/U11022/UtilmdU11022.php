<?php

namespace Proengeno\EdiEnergy\Utilmd\U11022;

use Proengeno\EdiEnergy\Edifact;

class UtilmdU11022 extends Edifact
{
    protected static $blueprint = [
        ['name' => 'UNA'],
        ['name' => 'UNB'],
        ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'UNH'],
            ['name' => 'BGM', 'templates' => ['docCode' => ['E01', 'E02', 'E35']]],
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
            ['name' => 'IMD', 'templates' => ['code' => ['Z14'], 'qualifier' => ['Z06', 'Z07']]],
            ['name' => 'STS', 'templates' => ['category' => [7], 'code' => ['E05']]],
            ['name' => 'FTX', 'necessity' => 'O'],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11022']]],
            ['name' => 'RFF', 'templates' => ['code' => ['ACW']]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ];
}
