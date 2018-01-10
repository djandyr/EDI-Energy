<?php

return [
    'type' => 'UTILMD',
    'name' => 'UtilmdU11062',
    'versions' => [
        'syntax_id' => 'UNOC',
        'syntax_version' => 3,
        'version_number' => 'D',
        'organisation' => 'UN',
        'message_subtype' => '',
        'release_number' => '11A',
        'message_type' => 'UTILMD',
        'organisation_code' => '5.1g',
    ],
    'validation' => [
        ['name' => 'UNA', 'necessity' => 'O'],
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
            ['name' => 'DTM', 'templates' => ['qualifier' => [158], 'code' => [203]]],
            ['name' => 'LOC', 'necessity' => 'O', 'templates' => ['qualifier' => ['107']]],
            ['name' => 'LOC', 'necessity' => 'O', 'templates' => ['qualifier' => ['237']]],
            ['name' => 'LOC', 'necessity' => 'O', 'templates' => ['qualifier' => ['172']]],
            ['name' => 'LOC', 'necessity' => 'O', 'templates' => ['qualifier' => ['231']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11062']]],

            ['name' => 'SEQ', 'templates' => ['code' => ['Z01']]],
            ['name' => 'CCI', 'necessity' => 'O'],
            ['name' => 'CAV', 'necessity' => 'O'],

            ['name' => 'SEQ', 'templates' => ['code' => ['Z02']]],
            ['name' => 'PIA'],

            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ]
];
