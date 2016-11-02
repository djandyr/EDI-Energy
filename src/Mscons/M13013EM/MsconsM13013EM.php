<?php

namespace Proengeno\EdiEnergy\Mscons\M13013EM;

use Proengeno\EdiEnergy\Edifact;

class MsconsM13013EM extends Edifact
{
    protected static $blueprint = [
        ['name' => 'UNA', 'necessity' => 'O'],
        ['name' => 'UNB'],
        ['name' => 'UNH', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'BGM', 'templates' => ['docCode' => ['Z24'], 'messageCode' => [9]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [137], 'code' => [203]]],
            ['name' => 'RFF', 'templates' => ['code' => ['AGI']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['13013']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS']]],
            ['name' => 'CTA', 'necessity' => 'O', 'segments' => [
                ['name' => 'COM', 'maxLoops' => 5, 'necessity' => 'R']
            ]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MR']]],
            ['name' => 'UNS', 'templates' => ['code' => ['D']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['DP']]],
            ['name' => 'LOC', 'templates' => ['qualifier' => [172]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [492], 'code' => [610]]],
            ['name' => 'LIN'],
            ['name' => 'PIA', 'templates' => ['number' => [5], 'articleCode' => ['Z02']]],
            ['name' => 'QTY', 'templates' => ['qualifier' => [79]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [306], 'code' => [102]]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ];
}
