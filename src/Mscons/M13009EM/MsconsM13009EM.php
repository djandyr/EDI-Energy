<?php

return [
    'name' => 'MsconsM13009EM',
    'check_digit' => 13009,
    'versions' => [
        'syntax_id' => 'UNOC',
        'syntax_version' => 3,
        'version_number' => 'D',
        'organisation' => 'UN',
        'message_subtype' => 'EM',
        'release_number' => '04B',
        'message_type' => 'MSCONS',
        'organisation_code' => '2.2h',
    ],
    'validation' => [
        ['name' => 'UNA', 'necessity' => 'O'],
        ['name' => 'UNB'],
        ['name' => 'UNH', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'BGM', 'templates' => ['docCode' => [7, 9]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [137], 'code' => [203]]],
            ['name' => 'RFF', 'templates' => ['code' => ['AGI']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['13009']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
            ['name' => 'CTA', 'necessity' => 'O', 'segments' => [
                ['name' => 'COM', 'maxLoops' => 5, 'necessity' => 'R']
            ]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
            ['name' => 'UNS', 'templates' => ['code' => ['D']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['DP']]],
            ['name' => 'LOC', 'templates' => ['qualifier' => [172]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [9], 'code' => [102]]],
            ['name' => 'LIN'],
            ['name' => 'PIA', 'templates' => ['number' => [5], 'articleCode' => ['SRW']]],
            ['name' => 'QTY', 'templates' => ['qualifier' => [220, 67, 201, 20, 187]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [163], 'code' => [102]]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [164], 'code' => [102]]],
            ['name' => 'STS', 'necessity' => 'O'],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ]
];
