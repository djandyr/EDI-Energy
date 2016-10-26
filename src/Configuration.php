<?php

namespace Proengeno\EdiEnergy;

use Proengeno\Edifact\Configuration as BaseConfig;

class Configuration extends BaseConfig
{
    const GAS = 'gas';
    const ELECTRIC = 'electric';

    private $energyType;
    private $outputCharsetConverter;

    public function setEnergyType($energyType)
    {
        if (in_array($energyType, [self::GAS, self::ELECTRIC])) {
            $this->energyType = $energyType;
        }
    }

    public function getEnergyType()
    {
        return $this->energyType ?: self::ELECTRIC;
    }

    public function setOutputCharsetConverter(callable $outputCharsetConverter)
    {
        $this->outputCharsetConverter = $outputCharsetConverter;
    }

    public function getOutputCharsetConverter()
    {
        if (null === $this->outputCharsetConverter) {
            $this->outputCharsetConverter = function($string) {
                return $string;
            };
        }

        return $this->outputCharsetConverter;
    }
}
