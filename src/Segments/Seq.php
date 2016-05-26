<?php 

namespace Proengeno\EdiMessages\Segments;

use Proengeno\Edifact\Message\Segment;

class Seq extends Segment 
{
    protected static $validationBlueprint = [
        'SEQ' => ['SEQ' => 'M|a|3'],
        '1229' => ['1229' => 'M|an|3'],
    ];

    public static function fromAttributes($code)
    {
        return new static([
            'SEQ' => ['SEQ' => 'SEQ'],
            '1229' => ['1229' => $code],
        ]);
    }

    public function code()
    {
        return @$this->elements['1229']['1229'] ?: null;
    }
}
