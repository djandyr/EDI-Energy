<?php

return [
    'name' => 'OrdersO17102',
    'check_digit' => 17102,
    'versions' => [
        'syntax_id' => 'UNOC',
        'syntax_version' => 3,
        'version_number' => 'D',
        'organisation' => 'UN',
        'message_subtype' => '',
        'release_number' => '09B',
        'message_type' => 'ORDERS',
        'organisation_code' => '1.1g',
    ],
    'validation' => [
        ['name' => 'UNA'],
        ['name' => 'UNB'],
        ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'UNH'],
            ['name' => 'BGM', 'templates' => ['docCode' => [7, 'Z14']]],
            ['name' => 'DTM', 'templates' => ['qualifier' => [137], 'code' => [102]]],
            ['name' => 'IMD', 'templates' => ['code' => ['Z11', 'Z12', 'Z14']]],
            ['name' => 'IMD', 'templates' => ['code' => ['Z11', 'Z12', 'Z14']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['17102', '17103']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
            ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'O', 'segments' => [
                ['name' => 'CTA', 'necessity' => 'O'],
                ['name' => 'LOOP', 'maxLoops' => 5, 'necessity' => 'O', 'segments' => [
                    ['name' => 'COM', 'necessity' => 'R']
                ]]
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
    ]
];
