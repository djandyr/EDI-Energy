<?php

namespace Proengeno\EdiMessages;

use DateTime;
use Proengeno\Edifact\Templates\AbstractBuilder;

abstract class D_05A_UN_Builder extends AbstractBuilder
{
    const SYNTAX_ID = 'UNOC';
    const SYNTAX_VERSION = 3;
    const VERSION_NUMBER = 'D';
    const RELEASE_NUMBER = '05A';
    const ORGANISATION = 'UN';

    private $energyType;

    public function setEnergieType($energyType)
    {
        $this->energyType = $energyType;
    }

    public function generateFilename()
    {
        return $filepath . '/'
            . static::MESSAGE_TYPE . '_'
            . static::MESSAGE_SUBTYPE . '_'
            . $this->from . '_'
            . $this->to . '_'
            . date('Ymd') . '_'
            . $this->unbReference() . '.txt';
    }

    protected function writeSeg($segment, $attributes = [], $method = 'fromAttributes')
    {
        if (isset($this->prebuildConfig['convertCharset'])) {
            array_walk($attributes, function(&$attribute, $key) {
                if (is_string($attribute)) {
                    $attribute = $this->prebuildConfig['convertCharset']($attribute);
                }
            });
        }
        parent::writeSeg($segment, $attributes, $method);
    }
    
    protected function writeUnb() 
    {
        return $this->writeSeg('unb', [
            self::SYNTAX_ID, 
            self::SYNTAX_VERSION, 
            $this->from, 
            $this->getMpCodeQualifier('unb', $this->from), 
            $this->to, 
            $this->getMpCodeQualifier('unb', $this->to), 
            new DateTime(), 
            $this->unbReference(),
            static::MESSAGE_SUBTYPE
        ]);
    }

    protected function getMpCodeQualifier($type, $mpCode) 
    {
        if ($this->energyType == 'gas') {
            switch ($type) {
                case 'unb':
                    return $mpCode[0] == '4' ? 14 : 502;
                case 'nad':
                    return $mpCode[0] == '4' ? 9 : 332;
            }
        }
        switch ($type) {
            case 'unb':
                return $mpCode[0] == '4' ? 14 : 500;
            case 'nad':
                return $mpCode[0] == '4' ? 9 : 293;
        }
    }
}
