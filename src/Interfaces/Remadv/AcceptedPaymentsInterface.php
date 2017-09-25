<?php

namespace Proengeno\EdiEnergy\Interfaces\Remadv;

interface AcceptedPaymentsInterface
{
    public function getInvoiceAmount();
    public function getPayedAmount();
    public function getInvoiceDate();
    public function getInvoiceCode();
    public function getAccountNumber();
}
