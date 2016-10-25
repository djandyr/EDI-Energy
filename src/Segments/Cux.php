<?php

namespace Proengeno\EdiEnergy\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Cux extends AbstractSegment
{
    protected static $validationBlueprint = [
        'CUX' => ['CUX' => 'M|a|3'],
        'C504' => ['6347' => 'M|an|3', '6345' => 'M|an|3', '6343' => 'M|an|3']
    ];

    public static function fromAttributes($type, $currency, $qualifier)
    {
        return new static([
            'CUX' => ['CUX' => 'CUX'],
            'C504' => ['6347' => $type, '6345' => $currency, '6343' => $qualifier],
        ]);
    }

    public function type()
    {
        return $this->elements['C504']['6347'];
    }

    public function currency()
    {
        return $this->elements['C504']['6345'];
    }

    public function qualifier()
    {
        return $this->elements['C504']['6343'];
    }
}
