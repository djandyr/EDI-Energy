<?php

namespace Proengeno\EdiEnergy\Utilmd\U11120;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierBalancingChangeInterface;

class UtilmdU11120Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11120;

    protected $bgmType = 'E03';

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11120Description.php';
    }

    protected function writeItem(SupplierBalancingChangeInterface $item)
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
