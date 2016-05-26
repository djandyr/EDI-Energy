<?php 

namespace Proengeno\EdiMessages\Segments;

use Proengeno\Edifact\Message\Segment;

class Uns extends Segment 
{
    protected static $validationBlueprint = [
        'UNS' => ['UNS' => 'M|a|3'],
        '0081' => ['0081' => 'M|a|1'],
    ];

    public static function fromAttributes($code = 'S')
    {
        return new static([
            'UNS' => ['UNS' => 'UNS'],
            '0081' => ['0081' => $code],
        ]);
    }

    public function code()
    {
        return @$this->elements['0081']['0081'] ?: null;
    }
}
