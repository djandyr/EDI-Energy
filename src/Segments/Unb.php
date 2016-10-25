<?php

namespace Proengeno\EdiEnergy\Segments;

use DateTime;
use Proengeno\Edifact\Templates\AbstractSegment;

class Unb extends AbstractSegment
{
    protected static $validationBlueprint = [
        'UNB' => ['UNB' => 'M|an|3'],
        'S001' => ['0001' => 'M|a|4', '0002' => 'm|n|1'],
        'S002' => ['0004' => 'M|an|35', '0007' => 'M|an|4'],
        'S003' => ['0010' => 'M|an|35', '0007' => 'M|an|4'],
        'S004' => ['0017' => 'M|n|6', '0019' => 'M|n|4'],
        '0020' => ['0020' => 'M|an|14'],
        'S005' => ['0022' => null],
        '0026' => ['0026' => 'O|an|14'],
        '0029' => ['0026' => null],
        '0031' => ['0026' => null],
        '0032' => ['0026' => null],
        '0035' => ['0035' => 'O|n|1'],
    ];

    public static function fromAttributes($syntaxId, $syntaxVersion, $sender, $senderQualifier, $receiver, $receiverQualifier, DateTime $creationDatetime, $referenzNumber, $usageType = null, $testMarker = null)
    {

        return new static([
            'UNB' => ['UNB' => 'UNB'],
            'S001' => ['0001' => $syntaxId, '0002' => $syntaxVersion],
            'S002' => ['0004' => $sender, '0007' => $senderQualifier],
            'S003' => ['0010' => $receiver, '0007' => $receiverQualifier],
            'S004' => ['0017' => $creationDatetime->format('ymd'), '0019' => $creationDatetime->format('hi')],
            '0020' => ['0020' => $referenzNumber],
            '0005' => [null],
            '0026' => ['0026' => $usageType],
            '0029' => [null],
            '0031' => [null],
            '0032' => [null],
            '0035' => ['0035' => $testMarker],
        ]);
    }

    public function syntaxId()
    {
        return $this->elements['S001']['0001'];
    }

    public function syntaxVersion()
    {
        return $this->elements['S001']['0002'];
    }

    public function sender()
    {
        return $this->elements['S002']['0004'];
    }

    public function senderQualifier()
    {
        return $this->elements['S002']['0007'];
    }

    public function receiver()
    {
        return $this->elements['S003']['0010'];
    }

    public function receiverQualifier()
    {
        return $this->elements['S003']['0007'];
    }

    public function creationDateTime()
    {
        return DateTime::createFromFormat('ymdhi', $this->elements['S004']['0017'] . $this->elements['S004']['0019']);
    }

    public function referenzNumber()
    {
        return $this->elements['0020']['0020'];
    }

    public function usageType()
    {
        return $this->elements['0026']['0026'];
    }

    public function testMarker()
    {
        return $this->elements['0035']['0035'];
    }
}
