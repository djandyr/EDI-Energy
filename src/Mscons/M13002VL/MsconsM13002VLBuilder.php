<?php

namespace Proengeno\EdiEnergy\Mscons\M13002VL;

use DateTime;
use Proengeno\EdiEnergy\Mscons\MsconsBuilder;

class MsconsM13002VLBuilder extends MsconsBuilder
{
    const CHECK_DIGIT = 13002;
    const MESSAGE_SUBTYPE = 'VL';

    public function getDescriptionPath()
    {
        return __DIR__ . '/MsconsM13002VL.php';
    }

    protected function writeMessage($item)
    {
        $this->writeSeg('Unh', [
            $this->unbReference(),
            $this->description->get('versions.message_type'),
            $this->description->get('versions.version_number'),
            $this->description->get('versions.release_number'),
            $this->description->get('versions.organisation'),
            $this->description->get('versions.organisation_code'),
        ]);
        $this->writeSeg('Bgm', [9, $this->unbReference(), 7]);
        $this->writeSeg('Dtm', [137, new DateTime, 203]);
        if ($ordesCode = $item->getOrdersCode()) {
            $this->writeSeg('Rff', ['AGI', $ordesCode]);
        }
        $this->writeSeg('Rff', ['Z13', static::CHECK_DIGIT]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Frau Refle']);
        $this->writeSeg('Com', ['04958 91570-08', 'TE']);
        $this->writeSeg('Com', ['i.refle@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');
        $this->writeSeg('Uns', ['D']);
        $this->writeSeg('Nad', ['DP', $item->getStreet(), $item->getStreetNumber(), $item->getCity(), $item->getZip()], 'fromAdress');
        $this->writeSeg('Loc', ['172', $item->getReportingPoint()]);
        $this->writeSeg('Dtm', [9, new DateTime, 102]);
        $this->writeSeg('Rff', ['MG', $item->getMeterNumber()]);
        $this->writeSeg('Cci', ['ACH', $item->getReadinReason()]);
        $this->writeSeg('Cci', [16, $item->getReadinType()]);
        $this->writeSeg('Lin', [1]);
        $this->writeSeg('Pia', [5, $item->getObis(), 'SRW']);
        $this->writeSeg('Qty', [$item->getReadingKind(), $item->getReadingAmount()]);
        $this->writeSeg('Dtm', [163, $item->getStartReadinDate(), 102]);
        $this->writeSeg('Dtm', [164, $item->getEndReadingDate(), 102]);
        $this->writeSeg('Dtm', [9, new DateTime, 102]);
        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }
}
