<?php 

namespace Proengeno\EdiMessages\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Cta extends AbstractSegment 
{
    protected static $validationBlueprint = [
        'CTA' => ['CTA' => 'M|a|3'],
        '3139' => ['3139' => 'M|an|3'],
        'C056' => ['3413' => null, '3412' => 'M|a|35'],
    ];

    public static function fromAttributes($type, $employee)
    {
        return new static([
            'CTA' => ['CTA' => 'CTA'],
            '3139' => ['3139' => $type],
            'C056' => ['3413' => null, '3412' => $employee],
        ]);
    }

    public function type()
    {
        return @$this->elements['3139']['3139'] ?: null;
    }

    public function employee()
    {
        return @$this->elements['C056']['3412'] ?: null;
    }
}
