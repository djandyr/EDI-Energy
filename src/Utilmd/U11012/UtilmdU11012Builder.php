<?php

namespace Proengeno\EdiEnergy\Utilmd\U11012;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\SupplierGridOperationSignOffAnswerInterface;

class UtilmdU11012Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11012;

    protected $bgmType = 'E02';

    protected function writeItem(SupplierGridOperationSignOffAnswerInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        $this->writeSeg('Sts', ['7', $item->getReason()]);
        $this->writeSeg('Sts', ['E01', $item->getAnswer()]);
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', self::CHECK_DIGIT]);
        $this->writeSeg('Rff', ['TN', $item->getRequestRef()]);
    }
}
