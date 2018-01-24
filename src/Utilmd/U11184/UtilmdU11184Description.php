<?php

return [
    'type' => 'UTILMD',
    'name' => 'UtilmdU11184',
    'check_digit' => 11184,
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
            ['name' => 'DTM', 'templates' => ['qualifier' => [92], 'code' => [102]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => [93], 'code' => [102]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => [155], 'code' => [102]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => [752], 'code' => [104, 106]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z09'], 'code' => [602]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => ['672'], 'code' => [802]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => [158], 'code' => [102]]],
            ['name' => 'DTM', 'necessity' => 'O', 'templates' => ['qualifier' => [158], 'code' => [102]]],
            ['name' => 'STS', 'templates' => ['category' => [7], 'reason' => ['E01', 'E02', 'E03', 'E04', 'ZD2']]],
            ['name' => 'STS', 'templates' => ['category' => ['E01'], 'reason' => ['E15', 'Z01', 'Z43']]],
            ['name' => 'AGR', 'templates' => ['qualifier' => [11], 'type' => ['E02']]],
            ['name' => 'AGR', 'templates' => ['qualifier' => ['E03'], 'type' => ['E10']]],
            ['name' => 'LOC', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z02', 'Z03']]],
            ['name' => 'LOC', 'templates' => ['qualifier' => ['107']]],
            ['name' => 'LOC', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z07']]],
            ['name' => 'LOC', 'templates' => ['qualifier' => ['237']]],
            ['name' => 'LOC', 'templates' => ['qualifier' => ['172']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['11002']]],
            ['name' => 'RFF', 'templates' => ['code' => ['TN']]],
            ['name' => 'LOOP', 'maxLoops' => 20, 'necessity' => 'O', 'segments' => [
                ['name' => 'CCI', 'necessity' => 'O'],
                ['name' => 'CAV', 'necessity' => 'O'],
            ]],

            ['name' => 'SEQ', 'templates' => ['code' => ['Z01']]],
            ['name' => 'RFF', 'templates' => ['code' => ['AVE']]],
            ['name' => 'LOOP', 'maxLoops' => 20, 'necessity' => 'O', 'segments' => [
                ['name' => 'QTY', 'necessity' => 'O'],
            ]],
            ['name' => 'LOOP', 'maxLoops' => 20, 'necessity' => 'O', 'segments' => [
                ['name' => 'CCI', 'necessity' => 'O'],
                ['name' => 'CAV', 'necessity' => 'O'],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z02']]],
                ['name' => 'RFF', 'templates' => ['code' => ['AVE']]],
                ['name' => 'RFF', 'necessity' => 'O', 'templatUtilmdU11002es' => ['code' => ['MG', 'Z11']]],
                ['name' => 'PIA'],
                ['name' => 'LOOP', 'maxLoops' => 20, 'necessity' => 'O', 'segments' => [
                    ['name' => 'CCI', 'necessity' => 'O'],
                    ['name' => 'CAV', 'necessity' => 'O'],
                ]],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z07']]],
                ['name' => 'RFF', 'templates' => ['code' => ['AVE']]],
                ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['Z10']]],
                ['name' => 'LOOP', 'maxLoops' => 20, 'necessity' => 'O', 'segments' => [
                    ['name' => 'CCI', 'necessity' => 'O'],
                    ['name' => 'CAV', 'necessity' => 'O'],
                ]],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z10']]],
                ['name' => 'RFF', 'templates' => ['code' => ['AVE']]],
                ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['Z10']]],
                ['name' => 'CCI'],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z12']]],
                ['name' => 'QTY'],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z03']]],
                ['name' => 'RFF', 'templates' => ['code' => ['AVE']]],
                ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['Z14']]],
                ['name' => 'LOOP', 'maxLoops' => 20, 'necessity' => 'O', 'segments' => [
                    ['name' => 'CCI', 'necessity' => 'O'],
                    ['name' => 'CAV', 'necessity' => 'O'],
                ]],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z04']]],
                ['name' => 'RFF', 'templates' => ['code' => ['MG']]],
                ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['Z14']]],
                ['name' => 'CCI'],
                ['name' => 'CAV'],
                ['name' => 'CAV'],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z09']]],
                ['name' => 'RFF', 'templates' => ['code' => ['MG']]],
                ['name' => 'CCI'],
                ['name' => 'CAV'],
                ['name' => 'CAV'],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z05']]],
                ['name' => 'RFF', 'templates' => ['code' => ['MG']]],
                ['name' => 'CCI'],
                ['name' => 'CAV'],
                ['name' => 'CAV'],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z06']]],
                ['name' => 'RFF', 'templates' => ['code' => ['MG']]],
                ['name' => 'CCI'],
                ['name' => 'CAV'],
                ['name' => 'CAV'],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z13']]],
                ['name' => 'RFF', 'templates' => ['code' => ['Z15']]],
                ['name' => 'CCI'],
                ['name' => 'CAV'],
            ]],

            ['name' => 'LOOP', 'maxLoops' => 1, 'necessity' => 'O', 'segments' => [
                ['name' => 'SEQ', 'templates' => ['code' => ['Z14']]],
                ['name' => 'RFF', 'templates' => ['code' => ['Z14']]],
                ['name' => 'RFF', 'templates' => ['code' => ['MG']]],
                ['name' => 'CCI'],
                ['name' => 'CAV'],
            ]],
            ['name' => 'NAD', 'necessity' => 'O', 'templates' => ['qualifier' => ['UD']]],
            ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['AVC']]],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['Z04']]],
            ['name' => 'NAD', 'necessity' => 'O', 'templates' => ['qualifier' => ['DEB']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z05']]],
            ['name' => 'RFF', 'templates' => ['code' => ['AVE']]],
            ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['MG']]],
            ['name' => 'NAD', 'necessity' => 'O', 'templates' => ['qualifier' => ['DDE']]],
            ['name' => 'RFF', 'templates' => ['code' => ['Z05']]],
            ['name' => 'RFF', 'templates' => ['code' => ['AVE']]],
            ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['MG']]],
            ['name' => 'NAD', 'necessity' => 'O', 'templates' => ['qualifier' => ['DP']]],
            ['name' => 'NAD', 'necessity' => 'O', 'templates' => ['qualifier' => ['Z05']]],
            ['name' => 'RFF', 'necessity' => 'O', 'templates' => ['code' => ['MG']]],
            ['name' => 'RFF', 'templates' => ['code' => ['AVE']]],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ]
];
