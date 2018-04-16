<?php

namespace Proengeno\EdiEnergy\Utilmd\U11009;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\Supplier\GridOperaterClosureResponseInterface;

class UtilmdU11009Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11009;
    const ANSWER_OTHER_REASON = 'E14';

    protected $bgmType = 'E02';

    protected function writeItem(GridOperaterClosureResponseInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        $this->writeSeg('Sts', ['7', 'Z33']);
        $this->writeSeg('Sts', ['E01', $item->getAnswer()]);
        if (static::ANSWER_OTHER_REASON == $item->getAnswer()) {
            $this->writeSeg('Ftx', ['ACB', $item->getComments()]);
        }
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', '11009']);
        $this->writeSeg('Rff', ['TN', $item->getRequestRef()]);
    }
}
