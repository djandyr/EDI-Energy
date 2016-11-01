<?php

namespace Proengeno\EdiEnergy\Mscons\M13014EM;

use DateTime;
use Proengeno\EdiEnergy\Mscons\MsconsBuilder;

class MsconsM13014EMBuilder extends MsconsBuilder
{
    protected $edifactClass = MsconsM13014EM::class;

    const CHECK_DIGIT = 13014;
    const MESSAGE_SUBTYPE = 'EM';

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
        $this->writeSeg('Bgm', [$item->getType(), $this->unbReference()]);
        $this->writeSeg('Dtm', [137, new DateTime, 102]);
        $this->writeSeg('Rff', [$item->getOrdersCode()]);
        $this->writeSeg('Rff', ['Z13', static::CHECK_DIGIT]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getMpCodeQualifier('nad', $this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Frau Refle']);
        $this->writeSeg('Com', ['04958 91570-08', 'TE']);
        $this->writeSeg('Com', ['i.refle@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getMpCodeQualifier('nad', $this->to)], 'fromMpCode');
        $this->writeSeg('Uns', ['D']);
        $this->writeSeg('Nad', ['DP', $item->getStreet(), $item->getStreetNumber(), $item->getCity(), $item->getZip()], 'fromAdress');
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Dtm', [9, $item->getFrom(), 102]);
        $this->writeSeg('Lin', [1]);
        $this->writeSeg('Pia', [5, $item->getObis(), 'SRW']);
        $this->writeSeg('Qty', [$item->getReadingKind(), $item->getAmount()]);
        $this->writeSeg('Dtm', [163, $item->getFrom(), 102]);
        $this->writeSeg('Dtm', [164, $item->getFrom(), 102]);
        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }
}
