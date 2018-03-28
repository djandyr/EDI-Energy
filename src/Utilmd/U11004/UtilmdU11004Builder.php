<?php

namespace Proengeno\EdiEnergy\Utilmd\U11004;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierGridOperationSignOffInterface;

class UtilmdU11004Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11004;

    protected $bgmType = 'E02';

    /**
     * Cancelation Reasons SupplierCancellationInterface::getReason, wich are revocations
     */
    private $revocations = [
        'ZG9', 'ZH1', 'ZH2'
    ];

    protected function writeItem(SupplierGridOperationSignOffInterface $item)
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
