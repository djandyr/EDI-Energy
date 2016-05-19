<?php

namespace Proengeno\EdiMessages\Remadv;

interface RemadvInterface
{
    public function getAmount();
    public function getInvoiceDate();
    public function getInvoiceCode();
    public function getAccountNumber();
}
