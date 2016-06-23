<?php

namespace Proengeno\EdiEnergy\Remadv;

use DateTime;
use Proengeno\EdiEnergy\D_05A_UN_Builder as Builder;

abstract class RemadvBuilder extends Builder
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
            $this->unbReference(), 
            self::MESSAGE_TYPE,
            self::VERSION_NUMBER,
            self::RELEASE_NUMBER, 
            self::ORGANISATION,
            self::ORGANISATION_CODE
        ]);
        $this->writeSeg('Bgm', [static::DOC_CODE, $this->unbReference().$this->unhCount()]);
        $this->writeSeg('Dtm', [137, new DateTime, 102]);
        $this->writeSeg('Rff', ['Z13', static::CHECK_DIGIT]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Frau Jacobs']);
        $this->writeSeg('Com', ['04958 91570-08', 'TE']);
        $this->writeSeg('Com', ['a.jacobs@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');
        $this->writeSeg('Cux', [2, 'EUR', 11]);
    }
}
