<?php

namespace Proengeno\EdiEnergy\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Sts extends AbstractSegment
{
    // protected static $jsonDescribtion = __DIR__ . '/meta/Sts.json';

    protected static $validationBlueprint = [
        'STS' => ['STS' => 'M|a|3'],
        'C601' => ['9015' => 'M|an|3'],
        'C555' => ['4405' => null],
        'C556' => ['9013' => 'M|an|3'],
    ];

    public static function fromAttributes($category, $reason)
    {
        return new static([
            'STS' => ['STS' => 'STS'],
            'C601' => ['9015' => $category],
            'C555' => ['4405' => null],
            'C556' => ['9013' => $reason],
        ]);
    }

    public function category()
    {
        return @$this->elements['C601']['9015'] ?: null;
    }

    public function reason()
    {
        return @$this->elements['C556']['9013'] ?: null;
    }
}
