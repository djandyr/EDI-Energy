<?php

namespace Proengeno\EdiEnergy\Utilmd\U11121;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierBalancingChangeInterface;

class UtilmdU11121Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11121;

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11121Description.php';
    }

    protected function writeMessage($items)
    {
        $this->writeSeg('Unh', [
            $this->unbReference(),
            $this->description->get('versions.message_type'),
            $this->description->get('versions.version_number'),
            $this->description->get('versions.release_number'),
            $this->description->get('versions.organisation'),
            $this->description->get('versions.organisation_code'),
        ]);
        $this->writeSeg('Bgm', ['E03', $this->unbReference()]);
        $this->writeSeg('Dtm', [137, new DateTime, 203]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Frau Hertema']);
        $this->writeSeg('Com', ['04958 91570-02', 'TE']);
        $this->writeSeg('Com', ['k.hertema@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');

        foreach ($items as $item) {
            $this->writeItem($item);
        }

        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }

    private function writeItem(SupplierBalancingChangeInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        $this->writeSeg('Dtm', ['92', $item->getContractStart(), 102]);
        $this->writeSeg('Dtm', ['157', $item->getChangesStart(), 102]);
        $this->writeSeg('Sts', ['7', 'ZE9']);

        if ($item->hasBalancingAreaChange()) {
            $this->writeSeg('Loc', ['237', $item->getBalancingArea()]);
        }

        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', self::CHECK_DIGIT]);

        $this->writeSeg('Seq', ['Z01']);
        $this->writeSeg('Cci', ['Z15', $item->getMeterpointType()]);
    }
}
