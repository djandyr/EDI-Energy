<?php

namespace Proengeno\EdiEnergy;

use Proengeno\Edifact\Configuration as BaseConfig;
use Proengeno\Edifact\Exceptions\EdifactException;

class Configuration extends BaseConfig
{
    const GAS = 'gas';
    const ELECTRIC = 'electric';

    private $defaultNamespace = '\Proengeno\EdiEnergy\Segments';

    private $energyType;
    private $outputCharsetConverter;

    public function setEnergyType($energyType)
    {
        if (!in_array($energyType, [self::GAS, self::ELECTRIC])) {
            throw new EdifactException("Energy-Type '$energyType' unkown!");
        }

        $this->energyType = $energyType;
    }

    public function getEnergyType()
    {
        return $this->energyType ?: self::ELECTRIC;
    }

    public function getSegmentNamespace()
    {
        if (null === parent::getSegmentNamespace()) {
            $this->setSegmentNamespace($this->defaultNamespace);
        }
        return parent::getSegmentNamespace();
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
