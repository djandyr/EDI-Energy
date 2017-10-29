<?php

return [
    'name' => 'RemadvR33001',
    'versions' => [
        'syntax_id' => 'UNOC',
        'syntax_version' => 3,
        'version_number' => 'D',
        'organisation' => 'UN',
        'message_subtype' => '',
        'release_number' => '05A',
        'message_type' => 'REMADV',
        'organisation_code' => '2.7c',
    ],
    'validation' => [
        ['name' => 'UNA'],
        ['name' => 'UNB'],
        ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'UNH'],
            ['name' => 'BGM', 'templates' => ['docCode' => ['239', '481']]],
            ['name' => 'DTM', 'templates' => ['qualifier' => ['137'], 'code' => ['102']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['33001']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
            ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'O', 'segments' => [
                ['name' => 'CTA', 'necessity' => 'O'],
                ['name' => 'LOOP', 'maxLoops' => 5, 'necessity' => 'O', 'segments' => [
                    ['name' => 'COM'],
                ]],
            ]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
            ['name' => 'CUX', 'templates' => ['currency' => ['EUR']]],
            ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
                ['name' => 'DOC', 'templates' => ['code' => ['380', '389', '457', 'Z25']]],
                ['name' => 'MOA', 'templates' => ['qualifier' => ['9']]],
                ['name' => 'MOA', 'templates' => ['qualifier' => ['12']]],
                ['name' => 'DTM', 'templates' => ['qualifier' => ['137'], 'code' => ['102']]],
            ]],
            ['name' => 'UNS', 'templates' => ['code' => ['S']]],
            ['name' => 'MOA', 'templates' => ['qualifier' => ['12']]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ]
];
