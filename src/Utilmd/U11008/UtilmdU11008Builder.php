<?php

namespace Proengeno\EdiEnergy\Utilmd\U11008;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;

class UtilmdU11008Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11008;

    protected $bgmType = 'E02';

    protected function writeItem($item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        $this->writeSeg('Dtm', ['93', $item->getSignOffDate(), 102]);
        $this->writeSeg('Dtm', ['159', $item->getBalancingEnd(), 102]);
        $this->writeSeg('Sts', ['7', 'Z33']);
        $this->writeSeg('Sts', ['E01', $item->getAnswer()]);
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', '11008']);
        $this->writeSeg('Rff', ['TN', $item->getRequestRef()]);
    }
}
