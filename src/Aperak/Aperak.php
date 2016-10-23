<?php

namespace Proengeno\EdiEnergy\Aperak;

use Proengeno\EdiEnergy\Edifact;

class Aperak extends Edifact
{
    const METERPOINT_UNKNOW = 'Z10';

    const SENDER_METERPOINT_MISMATCH = 'Z17';

    const ERR_RECEIVER_METERPOINT_MISMATCH = 'Z18';

    const UNKNOWN_METER_NO = 'Z19';

    const UNKNOWN_OBIS = 'Z20';

    const PROCESS_INTERN_REF_WRONG = 'Z21';

    const TUPLE_UNKOWN = 'Z24';

    const SENDER_TUPLE_MISMATCH = 'Z25';

    const RECEIVER_TUPLE_MISMATCH = 'Z26';

    const PREDECIMAL_OVERLENGTH = 'Z27';

    const REF_EVENT_UNKOWN = 'Z28';

    const TIME_SERIES_INCOMPLETE = 'Z30';

    const REF_TUPLE_UNKOWN = 'Z33';

    const DELIVERY_POINT_UNKOWN = 'Z14';

    const DELIVERY_POINT_AMBIGUOUS = 'Z15';

    const DELIVERY_POINT_GRID_MISMATCH = 'Z16';

    const REQUIRED_SPEC_MISSING = 'Z29';

    const EVENT_REJECTED = 'Z31';

    protected static $segments = [
        'UNA' => \Proengeno\EdiEnergy\Segments\Una::class,
        'UNB' => \Proengeno\EdiEnergy\Segments\Unb::class,
        'UNH' => \Proengeno\EdiEnergy\Segments\Unh::class,
        'BGM' => \Proengeno\EdiEnergy\Segments\Bgm::class,
        'DTM' => \Proengeno\EdiEnergy\Segments\Dtm::class,
        'RFF' => \Proengeno\EdiEnergy\Segments\Rff::class,
        'NAD' => \Proengeno\EdiEnergy\Segments\Nad::class,
        'CTA' => \Proengeno\EdiEnergy\Segments\Cta::class,
        'COM' => \Proengeno\EdiEnergy\Segments\Com::class,
        'ERC' => \Proengeno\EdiEnergy\Segments\Erc::class,
        'FTX' => \Proengeno\EdiEnergy\Segments\Ftx::class,
        'UNS' => \Proengeno\EdiEnergy\Segments\Uns::class,
        'UNT' => \Proengeno\EdiEnergy\Segments\Unt::class,
        'UNZ' => \Proengeno\EdiEnergy\Segments\Unz::class,
    ];

    public function getValidationBlueprint()
    {
        return [
            ['name' => 'UNA', 'necessity' => 'O'],
            ['name' => 'UNB'],
            ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
                ['name' => 'UNH'],
                ['name' => 'BGM', 'templates' => ['docCode' => ['239', '481']]],
                ['name' => 'DTM', 'templates' => ['qualifier' => ['137'], 'code' => ['102']]],
                ['name' => 'RFF', 'templates' => ['code' => ['ACE']]],
                ['name' => 'DTM', 'templates' => ['qualifier' => ['171'], 'code' => ['203']]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['MS']]],
                ['name' => 'LOOP', 'maxLoops' => 999999, 'necessity' => 'O', 'segments' => [
                    ['name' => 'CTA', 'necessity' => 'O'],
                    ['name' => 'LOOP', 'maxLoops' => 5, 'necessity' => 'O', 'segments' => [
                        ['name' => 'COM'],
                    ]],
                ]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['MR']]],
                ['name' => 'ERC'],
                ['name' => 'FTX', 'necessity' => 'O'],
                ['name' => 'RFF', 'templates' => ['code' => ['ACW']]],
                ['name' => 'RFF', 'templates' => ['code' => ['AGO']]],
                ['name' => 'FTX', 'necessity' => 'O'],
                ['name' => 'FTX', 'necessity' => 'O'],
                ['name' => 'RFF', 'templates' => ['code' => ['TN']]],
                ['name' => 'FTX', 'necessity' => 'O'],
                ['name' => 'FTX', 'necessity' => 'O'],
                ['name' => 'RFF', 'templates' => ['code' => ['Z08']]],
                ['name' => 'UNT'],
            ]],
            ['name' => 'UNZ']
        ];
    }
}
