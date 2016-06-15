<?php

namespace Proengeno\EdiEnergy;

use DateTime;
use Proengeno\Edifact\Templates\AbstractBuilder;

abstract class D_05A_UN_Builder extends AbstractBuilder
{
    const SYNTAX_ID = 'UNOC';
    const SYNTAX_VERSION = 3;
    const VERSION_NUMBER = 'D';
    const RELEASE_NUMBER = '05A';
    const ORGANISATION = 'UN';

    protected $prebuildConfig = [
        'unbReference' => null, 'delimiter' => null, 'energyType' => null, 'convertCharset' => null
    ];

    public function getEnergyType()
    {
        if (!isset($this->buildCache['energyType'])) {
            return $this->buildCache['energyType'] = $this->getPrebuildConfig('energyType');
        }

        return $this->buildCache['energyType'];
    }

    public function generateFilename()
    {
        return static::MESSAGE_TYPE . '_'
            . static::MESSAGE_SUBTYPE . '_'
            . $this->from . '_'
            . $this->to . '_'
            . date('Ymd') . '_'
            . $this->unbReference() . '.txt';
    }

    protected function writeSeg($segment, $attributes = [], $method = 'fromAttributes')
    {
        if (isset($this->prebuildConfig['convertCharset'])) {
            array_walk($attributes, function(&$attribute) {
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
            $this->getUnbQualifier($this->from), 
            $this->to, 
            $this->getUnbQualifier($this->to), 
            new DateTime(), 
            $this->unbReference(),
            static::MESSAGE_SUBTYPE
        ]);
    }

    protected function getUnbQualifier($mpCode) 
    {
        if ($mpCode[0] == '4') {
            return 4;
        }
        if ($this->getEnergyType() == 'gas') {
            return 502;
        }
        return 500;
    }

    protected function getNadQualifier($mpCode) 
    {
        if ($mpCode[0] == '4') {
            return 9;
        }
        if ($this->getEnergyType() == 'gas') {
            return 332;
        }
        return 293;
    }
}
