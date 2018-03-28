<?php

namespace Proengeno\EdiEnergy\Utilmd\U11017;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;
use Proengeno\EdiEnergy\Interfaces\Utilmd\Supplier\SupllierSignOffAcceptedResponseInterface;

class UtilmdU11017Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11017;

    protected $bgmType = 'E35';

    protected function writeItem(SupllierSignOffAcceptedResponseInterface $item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        if ($item->isFixedSignOff()) {
            $this->writeSeg('Dtm', ['93', $item->getSignOffDate(), 102]);
        }
        if (!$item->isFixedSignOff()) {
            $this->writeSeg('Dtm', ['471', $item->getSignOffDate(), 102]);
        }
        $this->writeSeg('Sts', ['7', 'E03']);
        $this->writeSeg('Sts', ['E01', $item->getAnswer()]);
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('Rff', ['Z13', self::CHECK_DIGIT]);
        $this->writeSeg('Rff', ['TN', $item->getRequestRef()]);

        $this->writeSeg('Seq', ['Z01']);
        $this->writeSeg('Qty', ['Z09', $item->getAnnualConsumption(), 'KWH']);

        $this->writeSeg('Seq', ['Z03']);
        $this->writeSeg('Cci', [null, 'E13']);
        $this->writeSeg('Cav', ['Z30', null, $item->getMeterNumber()]);

        if ($item->getCompany() === null) {
            $this->writeSeg('Nad', ['UD', $item->getLastName(), $item->getFirstName()], 'fromPerson');
        } else {
            $this->writeSeg('Nad', ['UD', $item->getCompany()], 'fromCompany');
        }

        $this->writeSeg('Nad', [
            'DP',
            $item->getStreet(),
            $item->getStreetNumber(),
            $item->getCity(),
            $item->getZip()
        ], 'fromAdress');
    }
}
