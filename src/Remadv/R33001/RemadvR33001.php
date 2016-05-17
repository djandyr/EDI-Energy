<?php

namespace Proengeno\EdiMessages\Remadv\R33001;

use Proengeno\Edifact\Message\Message;

class RemadvR33001 extends Message
{
    protected static $validationBlueprint = [
        ['name' => 'UNA'],
        ['name' => 'UNH', 'maxLoops' => 10, 'necessity' => 'R', 'segments' => [
            ['name' => 'BGM', 'templates' => ['docCode' => ['7', '380']] ],
            ['name' => 'LIN', 'maxLoops' => 5, 'necessity' => 'R', 'segments' => [
                ['name' => 'DTM'],
            ]],
            ['name' => 'UNS'],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ];
    
    public static function build($from, $to)
    {
        return new Builder($from, $to);
    }
}
