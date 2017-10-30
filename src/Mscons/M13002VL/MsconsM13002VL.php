<?php

$readingReasons = ['COM', 'IOM', 'ROM', 'COS', 'COB', 'CMP', 'PMR', 'COT'];
$readingNotes = ['SMV', 'EMV', 'MRV'];

return [
    'name' => 'MsconsM13002VL',
    'check_digit' => 13002,
    'versions' => [
        'syntax_id' => 'UNOC',
        'syntax_version' => 3,
        'version_number' => 'D',
        'organisation' => 'UN',
        'message_subtype' => 'VL',
        'release_number' => '04B',
        'message_type' => 'MSCONS',
        'organisation_code' => '2.2h',
    ],
    'validation' => [
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
            ['name' => 'CCI', 'templates' => ['type' => ['ACH'], 'code' => $readingReasons]],
            ['name' => 'CCI', 'templates' => ['type' => [16], 'code' => $readingNotes]],
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
    ]
];
