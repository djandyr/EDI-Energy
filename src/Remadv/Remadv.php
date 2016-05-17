<?php

namespace Proengeno\EdiMessages\Remadv;

interface Remadv
{
    public function getAmount();
    public function getInvoiceDate();
    public function getInvoiceCode();
    public function getAccountNumber();
}
