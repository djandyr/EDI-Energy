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
            'C186' => ['6063' => $qualifier, '6060' => (string)$amount, '6411' => $unitCode],
        ]);
    }

    public function qualifier()
    {
        return @$this->elements['C186']['6063'] ?: null;
    }

    public function amount()
    {
        return isset($this->elements['C186']['6060']) ? $this->elements['C186']['6060'] : null;
    }

    public function unitCode()
    {
        return @$this->elements['C186']['6411'] ?: null;
    }
}
