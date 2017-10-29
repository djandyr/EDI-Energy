<?php

return [
    'name' => 'UtilmdU11003',
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
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z07'], 'code' => [102]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z08'], 'code' => [102]]],
            ['name' => 'STS', 'templates' => ['category' => [7]]],
            ['name' => 'STS', 'necessity' => 'O', 'templates' => ['category' => ['Z17']]],
            ['name' => 'STS', 'templates' => ['category' => ['E01']]],
            ['name' => 'FTX', 'necessity' => 'O'],
            ['name' => 'LOC', 'templates' => ['qualifier' => ['172']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11003']]],
            ['name' => 'RFF', 'templates' => ['code' => ['TN']]],
            ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['Z07']]],
            ['name' => 'NAD', 'necessity' => 'O', 'templates' => ['qualifier' => ['VY']]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ]
];
