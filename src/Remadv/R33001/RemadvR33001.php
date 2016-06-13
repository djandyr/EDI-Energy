<?php

namespace Proengeno\EdiMessages\Remadv\R33001;

use Proengeno\EdiMessages\D_05A_UN;


class RemadvR33001 extends D_05A_UN
{
    protected static $builderClass = RemadvR33001Builder::class;
    protected static $segments = [
        'UNA' => \Proengeno\EdiMessages\Segments\Una::class,
        'UNB' => \Proengeno\EdiMessages\Segments\Unb::class,
        'UNH' => \Proengeno\EdiMessages\Segments\Unh::class,
        'BGM' => \Proengeno\EdiMessages\Segments\Bgm::class,
        'DTM' => \Proengeno\EdiMessages\Segments\Dtm::class,
        'RFF' => \Proengeno\EdiMessages\Segments\Rff::class,
        'NAD' => \Proengeno\EdiMessages\Segments\Nad::class,
        'CTA' => \Proengeno\EdiMessages\Segments\Cta::class,
        'COM' => \Proengeno\EdiMessages\Segments\Com::class,
        'CUX' => \Proengeno\EdiMessages\Segments\Cux::class,
        'DOC' => \Proengeno\EdiMessages\Segments\Doc::class,
        'MOA' => \Proengeno\EdiMessages\Segments\Moa::class,
        'UNS' => \Proengeno\EdiMessages\Segments\Uns::class,
        'UNT' => \Proengeno\EdiMessages\Segments\Unt::class,
        'UNZ' => \Proengeno\EdiMessages\Segments\Unz::class,
    ];
    
    public function getValidationBlueprint()
    {
        return [
            ['name' => 'UNA'],
            ['name' => 'UNB'],
            ['name' => 'UNH', 'maxLoops' => 999999, 'necessity' => 'R', 'segments' => [
                ['name' => 'BGM', 'templates' => ['docCode' => ['239', '481']]],
                ['name' => 'DTM', 'templates' => ['qualifier' => ['137'], 'code' => ['102']]],
                ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['33001', '33002']]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
                ['name' => 'CTA', 'necessity' => 'O', 'segments' => [
                    ['name' => 'COM', 'maxLoops' => 5, 'necessity' => 'R']
                ]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
                ['name' => 'CUX', 'templates' => ['currency' => ['EUR']]],
                ['name' => 'DOC', 'maxLoops' => 999999, 'templates' => ['code' => ['380', '389', '457', 'Z25']], 'segments' => [
                    ['name' => 'MOA', 'templates' => ['qualifier' => ['9']]],
                    ['name' => 'MOA', 'templates' => ['qualifier' => ['12']]],
                    ['name' => 'DTM', 'templates' => ['qualifier' => ['137'], 'code' => ['102']]],
                ]],
                ['name' => 'UNS', 'templates' => ['code' => ['S']]],
                ['name' => 'MOA', 'templates' => ['qualifier' => ['12']]],
                ['name' => 'UNT'],
            ]],
            ['name' => 'UNZ']
        ];
    }
}
