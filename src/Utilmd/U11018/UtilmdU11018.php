<?php

return array_merge(
    include(__DIR__ . '/../../DescriptionTemplates/Utilmd/SignOff.php'),
    [
        'name' => 'UtilmdU11018',
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
                ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z05', 'Z06'], 'code' => ['102']]],
                ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['157'], 'code' => [102]]],
                ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z01'], 'code' => ['Z01']]],
                ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z10'], 'code' => [102, 106]]],
                ['name' => 'STS', 'templates' => ['category' => [7], 'reason' => ['E03']]],
                ['name' => 'STS', 'templates' => ['category' => ['E01']]],
                ['name' => 'FTX', 'necessity' => 'O'],
                ['name' => 'LOC', 'templates' => ['qualifier' => ['172']]],
                ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11018']]],
                ['name' => 'RFF', 'templates' => ['code' => ['TN']]],
                ['name' => 'UNT'],
            ]],
            ['name' => 'UNZ']
        ]
    ]
);
