<?php

namespace Proengeno\EdiEnergy;

use Proengeno\Edifact\Configuration as BaseConfig;
use Proengeno\Edifact\Exceptions\EdifactException;

class Configuration extends BaseConfig
{
    const GAS = 'gas';
    const ELECTRIC = 'electric';

    private $energyType;

    /** Dont allow generic Segments */
    protected $genericSegment = null;

    protected $segmentNamespace = '\Proengeno\Ediseg\Segments';

    protected $builder = [
        'Contrl' => 'Proengeno\EdiEnergy\Contrl\ContrlBuilder',
        'OrdersO17103' => 'Proengeno\EdiEnergy\Orders\O17103\OrdersO17103Builder',
        'OrdersO17102' => 'Proengeno\EdiEnergy\Orders\O17102\OrdersO17102Builder',
        'RemadvR33001' => 'Proengeno\EdiEnergy\Remadv\R33001\RemadvR33001Builder',
        'RemadvR33002' => 'Proengeno\EdiEnergy\Remadv\R33002\RemadvR33002Builder',
        'MsconsM13002VL' => 'Proengeno\EdiEnergy\Mscons\M13002VL\MsconsM13002VLBuilder',
        'UtilmdU11004' => 'Proengeno\EdiEnergy\Utilmd\U11004\UtilmdU11004Builder',
        'UtilmdU11011' => 'Proengeno\EdiEnergy\Utilmd\U11011\UtilmdU11011Builder',
        'UtilmdU11012' => 'Proengeno\EdiEnergy\Utilmd\U11012\UtilmdU11012Builder',
        'UtilmdU11016' => 'Proengeno\EdiEnergy\Utilmd\U11016\UtilmdU11016Builder',
        'UtilmdU11120' => 'Proengeno\EdiEnergy\Utilmd\U11120\UtilmdU11120Builder',
        'UtilmdU11077' => 'Proengeno\EdiEnergy\Utilmd\U11077\UtilmdU11077Builder',
    ];

    public function getMessageDescriptions()
    {
        $preDefinedDescriptions = [
            __DIR__ . '/Utilmd/U11002/UtilmdU11002.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11002/'
            ],
            __DIR__ . '/Utilmd/U11003/UtilmdU11003.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11003/'
            ],
            __DIR__ . '/Utilmd/U11005/UtilmdU11005.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11005/'
            ],
            __DIR__ . '/Utilmd/U11006/UtilmdU11006.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11006/'
            ],
            __DIR__ . '/Utilmd/U11007/UtilmdU11007.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11007/'
            ],
            __DIR__ . '/Utilmd/U11010/UtilmdU11010.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11010/'
            ],
            __DIR__ . '/Utilmd/U11013/UtilmdU11013.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11013/'
            ],
            __DIR__ . '/Utilmd/U11016/UtilmdU11016.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11016/'
            ],
            __DIR__ . '/Utilmd/U11017/UtilmdU11017.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11017/'
            ],
            __DIR__ . '/Utilmd/U11018/UtilmdU11018.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11018/'
            ],
            __DIR__ . '/Utilmd/U11022/UtilmdU11022.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11022/'
            ],
            __DIR__ . '/Utilmd/U11023/UtilmdU11023.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11023/'
            ],
            __DIR__ . '/Utilmd/U11024/UtilmdU11024.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11024/'
            ],
            __DIR__ . '/Utilmd/U11036/UtilmdU11036.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11036/'
            ],
            __DIR__ . '/Utilmd/U11037/UtilmdU11037.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11037/'
            ],
            __DIR__ . '/Utilmd/U11038/UtilmdU11038.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11038/'
            ],
            __DIR__ . '/Utilmd/U11062/UtilmdU11062.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11062/'
            ],
            __DIR__ . '/Utilmd/U11063/UtilmdU11063.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11063/'
            ],
            __DIR__ . '/Utilmd/U11092/UtilmdU11092Description.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11092/'
            ],
            __DIR__ . '/Utilmd/U11093/UtilmdU11093Description.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11093/'
            ],
            __DIR__ . '/Utilmd/U11094/UtilmdU11094Description.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11094/'
            ],
            __DIR__ . '/Utilmd/U11080/UtilmdU11080Description.php' => [
                'UNH' => '/UNH\+(.*?)\+UTILMD\:/', 'RFF' => '/RFF\+Z13\:11080/'
            ],
            __DIR__ . '/Orders/O17102/OrdersO17102.php' => [
                'UNH' => '/UNH\+(.*?)\+ORDERS\:/', 'RFF' => '/RFF\+Z13\:17102/'
            ],
            __DIR__ . '/Orders/O17103/OrdersO17103.php' => [
                'UNH' => '/UNH\+(.*?)\+ORDERS\:/', 'RFF' => '/RFF\+Z13\:17103/'
            ],
            __DIR__ . '/Remadv/R33001/RemadvR33001.php' => [
                'UNH' => '/UNH\+(.*?)\+REMADV\:/', 'RFF' => '/RFF\+Z13\:33001/'
            ],
            __DIR__ . '/Mscons/M13002VL/MsconsM13002VL.php' => [
                'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13002/'
            ],
            __DIR__ . '/Mscons/M13006VL/MsconsM13006VL.php' => [
                'UNB' => '/UNB\+(.*?)\+\+VL/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13006/'
            ],
            __DIR__ . '/Mscons/M13006EM/MsconsM13006EM.php' => [
                'UNB' => '/UNB\+(.*?)\+\+EM/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13006/'
            ],
            __DIR__ . '/Mscons/M13009EM/MsconsM13009EM.php' => [
                'UNB' => '/UNB\+(.*?)\+\+EM/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13009/'
            ],
            __DIR__ . '/Mscons/M13013EM/MsconsM13013EM.php' => [
                'UNB' => '/UNB\+(.*?)\+\+EM/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13013/'
            ],
            __DIR__ . '/Mscons/M13014EM/MsconsM13014EM.php' => [
                'UNB' => '/UNB\+(.*?)\+\+EM/', 'UNH' => '/UNH\+(.*?)\+MSCONS\:/', 'RFF' => '/RFF\+Z13\:13014/'
            ],
        ];

        return array_merge($this->messageDescriptions, $preDefinedDescriptions);
    }

    public function getWriteFilter()
    {
        $preDefinedFilter = [
            function ($string) {
                $toChar = 'ISO-8859-1';
                $fromChar = 'UTF-8, CP1252, ISO-8859-1';

                $fromCharset = mb_detect_encoding($string, $fromChar);

                if ($fromCharset && $fromCharset != $toChar && $connvertedString = iconv($fromCharset, $toChar, $string)) {
                    return $connvertedString;
                }

                return $string;
            }
        ];

        return array_merge($this->writeFilter, $preDefinedFilter);
    }

    public function getReadFilter()
    {
        $preDefinedFilter = [
            function ($string) {
                $toChar = 'UTF-8';
                $fromChar = 'UTF-8, CP1252, ISO-8859-1';

                $fromCharset = mb_detect_encoding($string, $fromChar);

                if ($fromCharset && $fromCharset != $toChar && $connvertedString = iconv($fromCharset, $toChar, $string)) {
                    return $connvertedString;
                }

                return $string;
            }
        ];

        return array_merge($this->readFilter, $preDefinedFilter);
    }


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
}
