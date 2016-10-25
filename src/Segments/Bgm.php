<?php

namespace Proengeno\EdiEnergy\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Bgm extends AbstractSegment
{
    protected static $validationBlueprint = [
        'BGM' => ['BGM' => 'M|a|3'],
        'C002' => ['1001' => 'M|an|3'],
        'C106' => ['1004' => 'M|an|35'],
        '1225' => ['1225' => 'O|an|3'],
    ];

    public static function fromAttributes($docCode, $docNumber, $messageCode = null)
    {
        return new static([
            'BGM' => ['BGM' => 'BGM'],
            'C002' => ['1001' => $docCode],
            'C106' => ['1004' => $docNumber],
            '1225' => ['1225' => $messageCode],
        ]);
    }

    public function docCode()
    {
        return $this->elements['C002']['1001'];
    }

    public function docNumber()
    {
        return $this->elements['C106']['1004'];
    }

    public function messageCode()
    {
        return $this->elements['1225']['1225'];
    }
}
