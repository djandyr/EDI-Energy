<?php 

namespace Proengeno\EdiMessages\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Agr extends AbstractSegment
{
    protected static $validationBlueprint = [
        'AGR' => ['AGR' => 'M|a|3'],
        'C543' => ['7431' => 'M|an|3', '7433' => 'M|an|3'],
    ];

    public static function fromAttributes($qualifier, $type)
    {
        return new static([
            'AGR' => ['AGR' => 'AGR'],
            'C543' => ['7431' => $qualifier, '7433' => $type],
        ]);
    }

    public function qualifier()
    {
        return @$this->elements['C543']['7431'] ?: null;
    }

    public function type()
    {
        return @$this->elements['C543']['7433'] ?: null;
    }
}
