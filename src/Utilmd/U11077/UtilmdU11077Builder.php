<?php

namespace Proengeno\EdiEnergy\Utilmd\U11077;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;

class UtilmdU11077Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11077;
    const DIRECT_MARKETING = 'Z19';

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11077.php';
    }

    protected function writeMessage($items)
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

        foreach ($items as $item) {
            $this->writeItem($item);
        }

        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }

    private function writeItem($item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z06']);
        $this->writeSeg('Dtm', ['92', $item->getSignOnDate(), 102]);
        $this->writeSeg('Sts', ['7', $item->getReason()]);
        $this->writeSeg('Sts', ['5', $item->getSaleForm()]);

        if ($item->getSaleForm() === self::DIRECT_MARKETING) {
            $this->writeSeg('Sts', ['Z16', $item->getRemoteControlCapability()]);
            $this->writeSeg('Agr', ['Z01', $item->getPaymentReceiver()]);
        }

        $this->writeSeg('Loc', ['237', $item->getBalancingGroup()]);
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', self::CHECK_DIGIT]);

        $this->writeSeg('Seq', ['Z01']);
        $this->writeSeg('Rff', ['AVE', $item->getMeterpoint()]);
        $this->writeSeg('Qty', ['11', $item->getDivisionPercent(), 'P1']);
    }
}
