<?php

namespace Proengeno\EdiEnergy;

use DateTime;
use Proengeno\EdiEnergy\Configuration;
use Proengeno\Edifact\Templates\AbstractBuilder;

abstract class EdifactBuilder extends AbstractBuilder
{
    const SYNTAX_ID = 'UNOC';
    const SYNTAX_VERSION = 3;
    const VERSION_NUMBER = 'D';
    const ORGANISATION = 'UN';

    public function __construct($to, Configuration $configuration, $filename = 'php://temp')
    {
        parent::__construct($to, $configuration, $filename);
    }

    public function getEnergyType()
    {
        return $this->configuration->getEnergyType();
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

    //public function unbReference()
    //{
    //    return substr(static::MESSAGE_TYPE, 0, 1) . strtoupper(parent::unbReference());
    //}

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
        $mpCode = (string)$mpCode;

        if ($mpCode == '') {
            return null;
        }

        if ($mpCode[0] == '4') {
            return 14;
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
