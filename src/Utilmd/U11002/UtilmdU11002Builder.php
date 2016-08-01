<?php

namespace Proengeno\EdiEnergy\Utilmd\U11002;

use DateTime;
use Proengeno\EdiEnergy\EdifactBuilder;

class UtilmdU11002Builder extends EdifactBuilder
{
    const CHECK_DIGIT = 11002;
    const MESSAGE_SUBTYPE = '';
    const MESSAGE_TYPE = 'UTILMD';
    const ORGANISATION_CODE = '5.1e';

    protected function getMessageClass()
    {
        return UtilmdU11002::class;
    }

    protected function writeMessage($item)
    {
        $this->writeSeg('Unh', [
            $this->unbReference(), 
            self::MESSAGE_TYPE,
            self::VERSION_NUMBER,
            self::RELEASE_NUMBER, 
            self::ORGANISATION,
            self::ORGANISATION_CODE
        ]);
        $this->writeSeg('Bgm', ['E01', $this->unbReference()]);
        $this->writeSeg('Dtm', [137, new DateTime, 203]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Herr Geerdes']);
        $this->writeSeg('Com', ['04958 91570-10', 'TE']);
        $this->writeSeg('Com', ['j.geerdes@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');
    }
}
