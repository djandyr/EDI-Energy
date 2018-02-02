<?php

namespace Proengeno\EdiEnergy\Invoic;

use DateTime;
use Proengeno\EdiEnergy\EdifactBuilder;

abstract class InvoicBuilder extends EdifactBuilder
{
    // const MESSAGE_SUBTYPE = '';
    // const RELEASE_NUMBER = '05A';
    // const MESSAGE_TYPE = 'REMADV';
    // const ORGANISATION_CODE = '2.7c';

    protected function writeMessage($items)
    {
        // $this->writeUnhHead();
        // foreach ($items as $item) {
        //     $this->writeUnhBody($item);
        // }
        // $this->writeUnhFoot();
    }

    private function writeUnhHead()
    {
        // $this->writeSeg('Unh', [
        //     $this->unbReference().$this->messageCount(),
        //     $this->description->get('versions.message_type'),
        //     $this->description->get('versions.version_number'),
        //     $this->description->get('versions.release_number'),
        //     $this->description->get('versions.organisation'),
        //     $this->description->get('versions.organisation_code'),
        // ]);
        // $this->writeSeg('Bgm', [static::DOC_CODE, $this->unbReference().$this->messageCount()]);
        // $this->writeSeg('Dtm', [137, new DateTime, 102]);
        // $this->writeSeg('Rff', ['Z13', static::CHECK_DIGIT]);
        // $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        // $this->writeSeg('Cta', ['IC', 'Frau Jacobs']);
        // $this->writeSeg('Com', ['04958 91570-08', 'TE']);
        // $this->writeSeg('Com', ['a.jacobs@proengeno.de', 'EM']);
        // $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');
        // $this->writeSeg('Cux', [2, 'EUR', 11]);
    }

    protected function writeUnhFoot()
    {
        // $this->writeSeg('Uns');
        // $this->writeSeg('Moa', [12, $this->getTotalPayedAmount()]);
        // $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference().$this->messageCount()]);
    }
}
