<?php

namespace Proengeno\EdiEnergy\Remadv\R33001;

use Proengeno\EdiEnergy\D_05A_UN;


class RemadvR33001 extends D_05A_UN
{
    protected static $builderClass = RemadvR33001Builder::class;
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
        'CUX' => \Proengeno\EdiEnergy\Segments\Cux::class,
        'DOC' => \Proengeno\EdiEnergy\Segments\Doc::class,
        'MOA' => \Proengeno\EdiEnergy\Segments\Moa::class,
        'UNS' => \Proengeno\EdiEnergy\Segments\Uns::class,
        'UNT' => \Proengeno\EdiEnergy\Segments\Unt::class,
        'UNZ' => \Proengeno\EdiEnergy\Segments\Unz::class,
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
