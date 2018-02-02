<?php

namespace Proengeno\EdiEnergy\Invoic\I31003;

use DateTime;
use Proengeno\EdiEnergy\Invoic\InvoicBuilder;
use Proengeno\EdiEnergy\Interfaces\Invoic\AcceptedPaymentsInterface;

class InvoicI31003Builder extends InvoicBuilder
{
    const CHECK_DIGIT = 31003;

    public function getDescriptionPath()
    {
        return __DIR__ . '/InvoicI31003Description.php';
    }

    protected function writeUnhBody(AcceptedPaymentsInterface $item)
    {
        // $this->writeSeg('Doc', [$item->getInvoiceCode(), $item->getAccountNumber()]);
        // $this->writeSeg('Moa', [9, $item->getInvoiceAmount()]);
        // $this->writeSeg('Moa', [12, $item->getPayedAmount()]);
        // $this->writeSeg('Dtm', [137, $item->getInvoiceDate(), 102]);

        // $this->sumPayedAmount = bcadd($this->sumPayedAmount, $item->getPayedAmount(), 2);
    }
}
