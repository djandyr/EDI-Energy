<?php

namespace Proengeno\EdiEnergy\Orders\O17103;

use DateTime;
use Proengeno\EdiEnergy\Orders\OrdersBuilder;

class OrdersO17103Builder extends OrdersBuilder
{
    const CHECK_DIGIT = 17103;

    public function getDescriptionPath()
    {
        return __DIR__ . '/OrdersO17103.php';
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
        $this->writeSeg('Bgm', [$item->getType(), $this->unbReference()]);
        $this->writeSeg('Dtm', [137, new DateTime, 102]);
        $this->writeSeg('Imd', [$item->getCode()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        $this->writeSeg('Rff', ['Z13', static::CHECK_DIGIT]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Frau Refle']);
        $this->writeSeg('Com', ['04958 91570-08', 'TE']);
        $this->writeSeg('Com', ['i.refle@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');
        $this->writeSeg('Nad', ['DP', $item->getStreet(), $item->getStreetNumber(), $item->getCity(), $item->getZip()], 'fromAdress');
        $this->writeSeg('LOC', ['172', $item->getMeterpoint()]);
        $this->writeSeg('LIN', [1]);
        $this->writeSeg('DTM', [163, $item->getFrom(), 303]);
        $this->writeSeg('DTM', [164, $item->getUntil(), 303]);
        $this->writeSeg('UNS', ['S']);
        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }
}
