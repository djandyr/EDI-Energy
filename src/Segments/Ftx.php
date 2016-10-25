<?php

namespace Proengeno\EdiEnergy\Segments;

use Proengeno\Edifact\Templates\AbstractSegment;

class Ftx extends AbstractSegment
{
    protected static $validationBlueprint = [
        'FTX' => ['FTX' => 'M|a|3'],
        '4451' => ['4451' => 'M|an|3'],
        '4453' => [null],
        'C107' => ['4441' => null],
        'C108' => ['4440:1' => 'O|an|512', '4440:2' => 'O|an|512', '4440:3' => 'O|an|512', '4440:4' => 'O|an|512', '4440:5' => 'O|an|512'],
    ];

    public static function fromAttributes($qualifier, $message)
    {
        return new static([
            'FTX' => ['FTX' => 'FTX'],
            '4451' => ['4451' => $qualifier],
            '4453' => [null],
            'C107' => ['4441' => null],
            'C108' => [
                '4440:1' => substr($message, 0, 512),
                '4440:2' => substr($message, 512, 512),
                '4440:3' => substr($message, 1024, 512),
                '4440:4' => substr($message, 1536, 512),
                '4440:5' => substr($message, 2048, 512),
            ]
        ]);
    }

    public function qualifier()
    {
        return $this->elements['4451']['4451'];
    }

    public function message()
    {
        $message = null;
        $i = 1;
        while (isset($this->elements['C108']["4440:$i"])) {
            $message .= $this->elements['C108']["4440:$i"];
            $i++;
        }
        return $message;
    }
}
