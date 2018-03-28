<?php

namespace Proengeno\EdiEnergy\Utilmd\U11077;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\Producer\SupplierGridOperationSignOnInterface;

class UtilmdU11077Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11077;
    const PROMOTED_DIRECT_MARKETING = 'Z19';

    protected $bgmType = 'E01';

    protected function writeItem(SupplierGridOperationSignOnInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z06']);
        $this->writeSeg('Dtm', ['92', $item->getSignOnDate(), 102]);
        $this->writeSeg('Sts', ['7', $item->getReason()]);
        $this->writeSeg('Sts', ['5', null, $item->getSaleForm()]);

        if ($item->getSaleForm() === self::PROMOTED_DIRECT_MARKETING) {
            $this->writeSeg('Sts', ['Z16', null, $item->getRemoteControlCapability()]);
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
