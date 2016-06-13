<?php 

namespace Proengeno\EdiMessages\Segments;

use DateTime;
use Proengeno\Edifact\Templates\AbstractSegment;
use Proengeno\Edifact\Exceptions\SegValidationException;

class Dtm extends AbstractSegment 
{
    protected static $validationBlueprint = [
        'DTM' => ['DTM' => 'M|a|3'],
        'C507' => ['2005' => 'M|an|3', '2380' => 'M|an|35', '2379' => 'M|an|3'],
    ];

    public static function fromAttributes($qualifier, DateTime $date, $code)
    {
        return new static([
            'DTM' => ['DTM' => 'DTM'],
            'C507' => ['2005' => $qualifier, '2380' => static::formatDate($date, $code), '2379' => $code],
        ]);
    }

    public static function formatDate($date, $code)
    {
        switch ($code) {
            case 102:
                return $date->format('YmdH');
            case 203:
               return $date->format('YmdHi');
            case 303: 
                return $date->format('YmdHi') . substr($date->format('O'), 0, 3);
            case 610: 
                return $date->format('YmdH');
        }

        throw SegValidationException::forKeyValue('DTM', $code, "Timecode unknown.");
    }

    public static function dateFromString($string, $code)
    {
        switch ($code) {
            case 102:
                return DateTime::createFromFormat('YmdH', $string);
            case 203:
                return DateTime::createFromFormat('YmdHi', $string);
            case 303: 
                return DateTime::createFromFormat('YmdHi', substr($string, 0, -3));
            case 610: 
                return DateTime::createFromFormat('YmdH', $string);
        }

        throw SegValidationException::forKeyValue('DTM', $code, "Timecode unknown.");
    }

    public function qualifier()
    {
        return @$this->elements['C507']['2005'] ?: null;
    }

    public function date()
    {
        return static::dateFromString($this->elements['C507']['2380'], $this->code());
    }

    public function code()
    {
        return @$this->elements['C507']['2379'] ?: null;
    }
}
