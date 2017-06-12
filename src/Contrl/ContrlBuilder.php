<?php

namespace Proengeno\EdiEnergy\Contrl;

use DateTime;
use Proengeno\EdiEnergy\EdifactBuilder;
use Proengeno\EdiEnergy\Interfaces\Contrl\ContrlInterface;

class ContrlBuilder extends EdifactBuilder
{
    const MESSAGE_SUBTYPE = '';
    const RELEASE_NUMBER = '3';
    const MESSAGE_TYPE = 'CONTRL';
    const ORGANISATION_CODE = '2.0';

    public function getDescriptionPath()
    {
        return __DIR__ . '/ContrlDescription.php';
    }

    protected function writeMessage($item)
    {
        $this->write($item);
    }

    private function write(ContrlInterface $item)
    {
        $this->writeSeg('Unh', [
            $this->unbReference(),
            self::MESSAGE_TYPE,
            self::VERSION_NUMBER,
            self::RELEASE_NUMBER,
            self::ORGANISATION,
            self::ORGANISATION_CODE
        ]);
        $this->writeSeg('Uci', [
            $item->getUnbReference(),
            $this->from,
            $this->getNadQualifier($this->from),
            $this->to,
            $this->getNadQualifier($this->to),
            $item->getStatusCode(),
        ]);
        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }
}
