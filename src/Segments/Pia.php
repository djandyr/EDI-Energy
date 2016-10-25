<?php

namespace Proengeno\EdiEnergy\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Pia extends AbstractSegment
{
    protected static $validationBlueprint = [
        'PIA' => ['PIA' => 'M|a|3'],
        '4347' => ['4347' => 'M|n|3'],
        'C212' => ['7140' => 'D|an|35', '7143' => 'D|an|3'],
    ];

    public static function fromAttributes($number, $articleNumber = null, $articleCode = null)
    {
        return new static([
            'PIA' => ['PIA' => 'PIA'],
            '4347' => ['4347' => $number],
            'C212' => ['7140' => $articleNumber, '7143' => $articleCode],
        ]);
    }

    public function number()
    {
        return $this->elements['4347']['4347'];
    }

    public function articleNumber()
    {
        return $this->elements['C212']['7140'];
    }

    public function articleCode()
    {
        return $this->elements['C212']['7143'];
    }
}
