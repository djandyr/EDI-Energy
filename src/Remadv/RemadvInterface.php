<?php

namespace Proengeno\EdiMessages\Remadv;

interface RemadvInterface
{
    public function getInvoiceAmount();
    public function getPayedAmount();
    public function getInvoiceDate();
    public function getInvoiceCode();
    public function getAccountNumber();
}
