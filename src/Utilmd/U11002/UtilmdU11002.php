<?php

namespace Proengeno\EdiEnergy\Utilmd\U11002;

use Proengeno\EdiEnergy\Edifact;

class UtilmdU11002 extends Edifact
{
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
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ];
}
