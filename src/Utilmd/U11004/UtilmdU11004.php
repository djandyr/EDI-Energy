<?php

return array_merge(
    include(__DIR__ . '/../../DescriptionTemplates/Utilmd/SignOn.php'),
    [
        'name' => 'UtilmdU11004',
        'validation' => [
            ['name' => 'UNA', 'necessity' => 'O'],
            ['name' => 'UNB'],
            ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
                ['name' => 'UNH'],
                ['name' => 'BGM', 'templates' => ['docCode' => ['E02']]],
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
                ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['92'], 'code' => [102]]],
                ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['93'], 'code' => [102]]],
                ['name' => 'STS', 'templates' => ['category' => [7]]],
                ['name' => 'FTX', 'necessity' => 'O'],
                ['name' => 'FTX', 'necessity' => 'O'],
                ['name' => 'LOC', 'templates' => ['qualifier' => ['172']]],
                ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11004']]],
                ['name' => 'UNT'],
            ]],
            ['name' => 'UNZ']
        ]
    ]
);
