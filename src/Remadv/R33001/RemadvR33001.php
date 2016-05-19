<?php

namespace Proengeno\EdiMessages\Remadv\R33001;

use Proengeno\Edifact\Message\Message;

class RemadvR33001 extends Message
{
    protected static $validationBlueprint = [
        ['name' => 'UNA'],
        ['name' => 'UNB'],
        ['name' => 'UNH', 'maxLoops' => 1000, 'necessity' => 'R', 'segments' => [
            ['name' => 'BGM', 'templates' => ['docCode' => ['239', '481']] ],
            ['name' => 'DTM', 'templates' => ['qualifier' => ['137'], 'code' => ['102']] ],
            ['name' => 'RFF', 'templates' => ['code' => ['Z13'], 'referenz' => ['33001', '33002']] ],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']] ],
            ['name' => 'NAD', 'templates' => ['qualifier' => ['MS', 'MR']] ],
            ['name' => 'CUX', 'templates' => ['currency' => ['EUR']] ],
            ['name' => 'DOC', 'maxLoops' => 1000, 'templates' => ['code' => ['380', '389', '457', 'Z25']], 'segments' => [
                ['name' => 'MOA', 'templates' => ['qualifier' => ['9']] ],
                ['name' => 'MOA', 'templates' => ['qualifier' => ['12']] ],
                ['name' => 'DTM', 'templates' => ['qualifier' => ['137'], 'code' => ['102']] ],
            ]],
            ['name' => 'UNS', 'templates' => ['code' => ['S']] ],
            ['name' => 'MOA', 'templates' => ['qualifier' => ['12']] ],
            ['name' => 'UNT'],
        ]],
        ['name' => 'UNZ']
    ];
    
    public static function build($from, $to)
    {
        return new Builder($from, $to);
    }
}
