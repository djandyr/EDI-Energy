<?php

return [
    'name' => 'UtilmdU11016',
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
            ['name' => 'BGM', 'templates' => ['docCode' => ['E35']]],
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
            ['name' => 'IMD', 'templates' => ['code' => ['Z14'], 'qualifier' => ['Z07']]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['93'], 'code' => [102]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['471'], 'code' => [102]]],
            ['name' => 'STS', 'templates' => ['category' => [7], 'reason' => ['E03']]],
            ['name' => 'FTX', 'necessity' => 'O', 'templates' => ['qualifier' => ['ACB']]],
            ['name' => 'LOC', 'necessity' => 'O', 'templates' => ['qualifier' => ['172']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11016']]],
            ['name' => 'SEQ', 'necessity' => 'O', 'templates' => ['code' => ['Z03']]],
            ['name' => 'CCI', 'necessity' => 'O', 'templates' => ['code' => ['E13']]],
            ['name' => 'CAV', 'necessity' => 'O', 'templates' => ['code' => ['Z30']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['UD']]],
            ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['Z01']]],
            ['name' => 'NAD', 'necessity' => 'O', 'templates' => ['qualifier' => ['DP']]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ]
];
