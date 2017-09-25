<?php

$invoiceCodes = ['380', '389', '457', 'Z25'];
$answers = ['5', '9', '28', '14' , '53', 'Z01', 'Z02', 'Z03', 'Z04', 'Z06', 'Z07', 'Z08', 'Z10', 'Z33', 'Z35', 'Z36', 'Z37', 'Z38', 'Z39', 'Z40', 'Z41', 'Z42', 'Z43', 'Z44', 'Z45', 'Z52', 'Z53'];

return [
    'name' => 'RemadvR33002',
    'validation' => [
        ['name' => 'UNA'],
        ['name' => 'UNB'],
        ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
            ['name' => 'UNH'],
            ['name' => 'BGM', 'templates' => ['docCode' => ['239', '481']]],
            ['name' => 'DTM', 'templates' => ['qualifier' => ['137'], 'code' => ['102']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['33002']]],
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
                ['name' => 'DOC', 'templates' => ['code' => $invoiceCodes]],
                ['name' => 'MOA', 'templates' => ['qualifier' => ['9']]],
                ['name' => 'MOA', 'templates' => ['qualifier' => ['12'], 'amount' => ['0.00']]],
                ['name' => 'DTM', 'templates' => ['qualifier' => ['137'], 'code' => ['102']]],
                ['name' => 'AJT', 'templates' => ['code' => $answers]],
                ['name' => 'FTX', 'necessity' => 'O'],
            ]],
            ['name' => 'UNS', 'templates' => ['code' => ['S']]],
            ['name' => 'MOA', 'templates' => ['qualifier' => ['12'], 'amount' => ['0.00']]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ]
];
