<?php

return [
    'name' => 'MsconsM13013EM',
    'check_digit' => 13013,
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
    ]
];
