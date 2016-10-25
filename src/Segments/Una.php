<?php

namespace Proengeno\EdiEnergy\Segments;

use Proengeno\Edifact\Message\Delimiter;
use Proengeno\Edifact\Templates\AbstractSegment;

class Una extends AbstractSegment
{
    protected static $validationBlueprint = [
        'UNA' => ['Una' => 'M|a|3', 'data' => 'M|an|1', 'dataGroup' => 'M|an|1', 'decimal' => 'M|an|1', 'terminator' => 'M|an|1', 'empty' => 'M|an|1'],
    ];

    public static function fromAttributes($data = ':', $dataGroup = '+', $decimal = '.', $terminator = '?', $empty = ' ')
    {
        static::setBuildDelimiter(new Delimiter($data, $dataGroup, $decimal, $terminator, $empty));
        return new static([
            'UNA' => ['UNA' => 'UNA', 'data' => $data, 'dataGroup' => $dataGroup, 'decimal' => $decimal, 'terminator' => $terminator, 'empty' => $empty],
        ]);
    }

    public function data()
    {
        return $this->elements['UNA']['data'];
    }

    public function dataGroup()
    {
        return $this->elements['UNA']['dataGroup'];
    }

    public function decimal()
    {
        return $this->elements['UNA']['decimal'];
    }

    public function terminator()
    {
        return $this->elements['UNA']['terminator'];
    }

    public function emptyChar()
    {
        return $this->elements['UNA']['empty'];
    }

    public function __toString()
    {
        return $this->cache['segLine'] = implode('', $this->elements['UNA']) . "'";
    }

    protected static function mapToBlueprint($segLine)
    {
        $inputElement = ['UNA'] + str_split(substr($segLine, 2));
        $i = 0;
        foreach (static::$validationBlueprint as $BpDataKey => $BPdataGroups) {
            if (isset($inputElement)) {
                $elements[$BpDataKey] = array_combine(array_keys($BPdataGroups), $inputElement);
            }
            $i++;
        }

        return @$elements ?: [];
    }
}
