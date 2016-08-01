<?php

namespace Proengeno\EdiEnergy\Remadv;

use DateTime;
use Proengeno\EdiEnergy\EdifactBuilder;

abstract class RemadvBuilder extends EdifactBuilder
{
    const MESSAGE_SUBTYPE = '';
    const MESSAGE_TYPE = 'REMADV';
    const ORGANISATION_CODE = '2.7b';
    
    protected function writeMessage($items)
    {
        $this->writeUnhHead();
        foreach ($items as $item) {
            $this->writeUnhBody($item);
        }
        $this->writeUnhFoot();
    }

    private function writeUnhHead()
    {
        $this->writeSeg('Unh', [
            $this->unbReference().$this->messageCount(), 
            self::MESSAGE_TYPE,
            self::VERSION_NUMBER,
            self::RELEASE_NUMBER, 
            self::ORGANISATION,
            self::ORGANISATION_CODE
        ]);
        $this->writeSeg('Bgm', [static::DOC_CODE, $this->unbReference().$this->messageCount()]);
        $this->writeSeg('Dtm', [137, new DateTime, 102]);
        $this->writeSeg('Rff', ['Z13', static::CHECK_DIGIT]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Frau Jacobs']);
        $this->writeSeg('Com', ['04958 91570-08', 'TE']);
        $this->writeSeg('Com', ['a.jacobs@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');
        $this->writeSeg('Cux', [2, 'EUR', 11]);
    }

    protected function writeUnhFoot()
    {
        $this->writeSeg('Uns');
        $this->writeSeg('Moa', [12, $this->getTotalPayedAmount()]);
        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference().$this->messageCount()]);
    }
}
