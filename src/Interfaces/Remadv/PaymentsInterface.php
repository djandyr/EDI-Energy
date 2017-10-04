<?php

namespace Proengeno\EdiEnergy\Interfaces\Remadv;

interface PaymentsInterface
{
    public function getInvoiceAmount();
    public function getInvoiceDate();
    public function getInvoiceCode();
    public function getAccountNumber();
}
