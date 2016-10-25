<?php

namespace Proengeno\EdiEnergy\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Moa extends AbstractSegment
{
    protected static $validationBlueprint = [
        'MOA' => ['MOA' => 'M|a|3'],
        'C516' => ['5025' => 'M|an|3', '5004' => 'M|n|35'],
    ];

    public static function fromAttributes($qualifier, $amount)
    {
        return new static([
            'MOA' => ['MOA' => 'MOA'],
            'C516' => ['5025' => $qualifier, '5004' => number_format($amount, 2, static::getBuildDelimiter()->getDecimal(), '')]
        ]);
    }

    public function qualifier()
    {
        return $this->elements['C516']['5025'];
    }

    public function amount()
    {
        return $this->elements['C516']['5004'];
    }
}
