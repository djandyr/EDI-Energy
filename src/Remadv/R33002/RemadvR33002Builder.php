<?php

namespace Proengeno\EdiEnergy\Remadv\R33002;

use DateTime;
use Proengeno\EdiEnergy\Remadv\RemadvBuilder;
use Proengeno\EdiEnergy\Interfaces\Remadv\RejectedPaymentsInterface;

class RemadvR33002Builder extends RemadvBuilder
{
    const DOC_CODE = 239;
    const CHECK_DIGIT = 33002;

    private $payedAmount = '0.00';

    public function getDescriptionPath()
    {
        return __DIR__ . '/RemadvR33002Description.php';
    }

    public function getTotalPayedAmount()
    {
        return $this->payedAmount;
    }

    protected function writeUnhBody(RejectedPaymentsInterface $item)
    {
        $this->writeSeg('Doc', [$item->getInvoiceCode(), $item->getAccountNumber()]);
        $this->writeSeg('Moa', [9, $item->getInvoiceAmount()]);
        $this->writeSeg('Moa', [12, $this->payedAmount]);
        $this->writeSeg('Dtm', [137, $item->getInvoiceDate(), 102]);
        $this->writeSeg('Ajt', [$item->getAnswer()]);
        if ($item->getComments() !== null) {
            $this->writeSeg('Ftx', ['ACB', $item->getComments()]);
        }
    }
}
