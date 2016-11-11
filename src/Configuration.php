<?php

namespace Proengeno\EdiEnergy;

use Proengeno\Edifact\Configuration as BaseConfig;
use Proengeno\Edifact\Exceptions\EdifactException;

class Configuration extends BaseConfig
{
    const GAS = 'gas';
    const ELECTRIC = 'electric';

    protected $segmentNamespace = '\Proengeno\EdiEnergy\Segments';
    protected $importAllocationRules = [
        '\Proengeno\EdiEnergy\Utilmd\U11002\UtilmdU11002' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11002/'],
        '\Proengeno\EdiEnergy\Utilmd\U11003\UtilmdU11003' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11003/'],
        '\Proengeno\EdiEnergy\Utilmd\U11005\UtilmdU11005' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11005/'],
        '\Proengeno\EdiEnergy\Utilmd\U11006\UtilmdU11006' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11006/'],
        '\Proengeno\EdiEnergy\Utilmd\U11010\UtilmdU11010' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11010/'],
        '\Proengeno\EdiEnergy\Utilmd\U11016\UtilmdU11016' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11016/'],
        '\Proengeno\EdiEnergy\Utilmd\U11017\UtilmdU11017' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11017/'],
        '\Proengeno\EdiEnergy\Utilmd\U11018\UtilmdU11018' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11018/'],
        '\Proengeno\EdiEnergy\Utilmd\U11022\UtilmdU11022' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11022/'],
        '\Proengeno\EdiEnergy\Utilmd\U11023\UtilmdU11023' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11023/'],
        '\Proengeno\EdiEnergy\Utilmd\U11024\UtilmdU11024' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11024/'],
        '\Proengeno\EdiEnergy\Utilmd\U11036\UtilmdU11036' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11036/'],
        '\Proengeno\EdiEnergy\Utilmd\U11037\UtilmdU11037' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11037/'],
        '\Proengeno\EdiEnergy\Utilmd\U11038\UtilmdU11038' => ['UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11038/'],
        '\Proengeno\EdiEnergy\Orders\O17102\OrdersO17102' => ['UNH' => '/UNH\+(.*?)\+ORDERS\:/', 'RFF' => '/RFF\+Z13\:17102/'],
        '\Proengeno\EdiEnergy\Orders\O17103\OrdersO17103' => ['UNH' => '/UNH\+(.*?)\+ORDERS\:/', 'RFF' => '/RFF\+Z13\:17103/'],
        '\Proengeno\EdiEnergy\Remadv\R33001\RemadvR33001' => ['UNH' => '/UNH\+(.*?)\+REMADV\:/', 'RFF' => '/RFF\+Z13\:33001/'],
        '\Proengeno\EdiEnergy\Mscons\M13002VL\MsconsM13002VL' => ['UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13002/'],
        '\Proengeno\EdiEnergy\Mscons\M13006VL\MsconsM13006VL' => ['UNB' => '/UNB\+(.*?)\+\+VL/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13006/'],
        '\Proengeno\EdiEnergy\Mscons\M13006EM\MsconsM13006EM' => ['UNB' => '/UNB\+(.*?)\+\+EM/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13006/'],
        '\Proengeno\EdiEnergy\Mscons\M13009EM\MsconsM13009EM' => ['UNB' => '/UNB\+(.*?)\+\+EM/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13009/'],
        '\Proengeno\EdiEnergy\Mscons\M13013EM\MsconsM13013EM' => ['UNB' => '/UNB\+(.*?)\+\+EM/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13013/'],
        '\Proengeno\EdiEnergy\Mscons\M13014EM\MsconsM13014EM' => ['UNB' => '/UNB\+(.*?)\+\+EM/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13014/'],
    ];

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
