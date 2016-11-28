<?php

namespace Proengeno\EdiEnergy\Remadv\R33001;

use DateTime;
use Proengeno\EdiEnergy\Remadv\RemadvBuilder;
use Proengeno\EdiEnergy\Interfaces\RemadvInterface;

class RemadvR33001Builder extends RemadvBuilder
{
    const DOC_CODE = 481;
    const CHECK_DIGIT = 33001;

    private $sumPayedAmount;

    public function getDescriptionPath()
    {
        return __DIR__ . '/RemadvR33001.php';
    }

    public function getTotalPayedAmount()
    {
        return $this->sumPayedAmount;
    }

    protected function writeUnhBody(RemadvInterface $item)
    {
        $this->writeSeg('Doc', [$item->getInvoiceCode(), $item->getAccountNumber()]);
        $this->writeSeg('Moa', [9, $item->getInvoiceAmount()]);
        $this->writeSeg('Moa', [12, $item->getPayedAmount()]);
        $this->writeSeg('Dtm', [137, $item->getInvoiceDate(), 102]);

        $this->sumPayedAmount = bcadd($this->sumPayedAmount, $item->getPayedAmount(), 2);
    }
}
