<?php

namespace Proengeno\EdiEnergy\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Qty extends AbstractSegment
{
    protected static $validationBlueprint = [
        'QTY' => ['QTY' => 'M|a|3'],
        'C186' => ['6063' => 'M|an|3', '6060' => 'M|an|35', '6411' => 'D|an|8'],
    ];

    public static function fromAttributes($qualifier, $amount, $unitCode = null)
    {
        return new static([
            'QTY' => ['QTY' => 'QTY'],
            'C186' => ['6063' => $qualifier, '6060' => $amount, '6411' => $unitCode],
        ]);
    }

    public function qualifier()
    {
        return $this->elements['C186']['6063'];
    }

    public function amount()
    {
        return $this->elements['C186']['6060'];
    }

    public function unitCode()
    {
        return $this->elements['C186']['6411'];
    }
}
