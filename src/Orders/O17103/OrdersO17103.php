<?php

namespace Proengeno\EdiEnergy\Orders\O17103;

use Proengeno\EdiEnergy\D_05A_UN;

class OrdersO17103 extends D_05A_UN
{
    protected static $builderClass = OrdersO17103Builder::class;
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
        'IMD' => \Proengeno\EdiEnergy\Segments\Imd::class,
        'LOC' => \Proengeno\EdiEnergy\Segments\Loc::class,
        'LIN' => \Proengeno\EdiEnergy\Segments\Lin::class,
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
                ['name' => 'BGM', 'templates' => ['docCode' => [7]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => [137], 'code' => [102]]],
                ['name' => 'IMD', 'templates' => ['code' => ['Z10', 'Z14', 'Z07']]],
                ['name' => 'IMD', 'templates' => ['code' => ['Z10', 'Z14', 'Z07']]],
                ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['17102', '17103']]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
                ['name' => 'CTA', 'necessity' => 'O', 'segments' => [
                    ['name' => 'COM', 'maxLoops' => 5, 'necessity' => 'R']
                ]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']]],
                ['name' => 'NAD', 'templates' => ['qualifier' => ['DP']]],
                ['name' => 'LOC', 'templates' => ['qualifier' => [172]]],
                ['name' => 'LIN'],
                ['name' => 'DTM', 'templates' => ['qualifier' => [163], 'code' => [303]]],
                ['name' => 'DTM', 'templates' => ['qualifier' => [164], 'code' => [303]]],
                ['name' => 'UNS', 'templates' => ['code' => ['S']]],
                ['name' => 'UNT'],
            ]],
            ['name' => 'UNZ']
        ];
    }
}
