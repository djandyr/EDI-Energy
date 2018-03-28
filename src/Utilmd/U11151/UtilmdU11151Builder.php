<?php

namespace Proengeno\EdiEnergy\Utilmd\U11151;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierBalancingChangeInterface;

class UtilmdU11151Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11151;

    protected $bgmType = 'E03';

    private $otherEegCompensation = 'Z21';

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11151Description.php';
    }

    protected function writeItem(SupplierBalancingChangeInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        $this->writeSeg('Dtm', ['92', $item->getContractStart(), 102]);
        $this->writeSeg('Dtm', ['157', $item->getChangesStart(), 102]);
        $this->writeSeg('Sts', ['7', 'ZF6']);
        $this->writeSeg('Sts', ['E01', $item->getAnswer()]);
        if ($item->getSaleForm()) {
            $this->writeSeg('Sts', ['5', $item->getSaleForm()]);
        }

        if ($item->getBalancingGroup()) {
            $this->writeSeg('Loc', ['237', $item->getBalancingGroup()]);
        }

        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', self::CHECK_DIGIT]);
        $this->writeSeg('Rff', ['TN', $item->getRequestRef()]);

        $this->writeSeg('Seq', ['Z01']);
        $this->writeSeg('Cci', ['Z15', $item->getMeterpointType()]);
    }
}
