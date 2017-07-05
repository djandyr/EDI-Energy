<?php

namespace Proengeno\EdiEnergy\Utilmd\U11004;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierGridOperationSignOffInterface;

class UtilmdU11004Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11004;

    /**
     * Cancelation Reasons SupplierCancellationInterface::getReason, wich are revocations
     */
    private $revocations = [
        'ZG9', 'ZH1', 'ZH2'
    ];

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11004.php';
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
        $this->writeSeg('Bgm', ['E02', $this->unbReference()]);
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

    private function writeItem(SupplierGridOperationSignOffInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);

        if ($this->isRevocation($item)) {
            $this->writeSeg('Dtm', ['92', $item->getContractStart(), 102]);
        } else {
            $this->writeSeg('Dtm', ['93', $item->getSignOffDate(), 102]);
        }
        $this->writeSeg('Sts', ['7', $item->getReason()]);
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', '11004']);
    }

    private function isRevocation($item)
    {
        return in_array($item->getReason(), $this->revocations);
    }
}
