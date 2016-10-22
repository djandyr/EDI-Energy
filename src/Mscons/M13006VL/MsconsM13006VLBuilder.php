<?php

namespace Proengeno\EdiEnergy\Mscons\M13006VL;

use DateTime;
use Proengeno\EdiEnergy\Mscons\MsconsBuilder;

class MsconsM13006VLBuilder extends MsconsBuilder
{
    protected $edifactClass = MsconsM13006VL::class;

    const CHECK_DIGIT = 13006;
    const MESSAGE_SUBTYPE = 'VL';

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
        $this->writeSeg('Bgm', [7, $this->unbReference(), 1]);
        $this->writeSeg('Dtm', [137, new DateTime, 203]);
        $this->writeSeg('Rff', ['ACW', $item->getOriginalMessageCode()]);
        $this->writeSeg('Rff', ['Z13', static::CHECK_DIGIT]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Frau Refle']);
        $this->writeSeg('Com', ['04958 91570-08', 'TE']);
        $this->writeSeg('Com', ['i.refle@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');
        $this->writeSeg('Uns', ['D']);
        $this->writeSeg('Nad', ['DP', $item->getStreet(), $item->getStreetNumber(), $item->getCity(), $item->getZip()], 'fromAdress');
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }
}
