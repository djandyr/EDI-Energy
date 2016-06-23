<?php

namespace Proengeno\EdiEnergy\Interfaces;

interface RemadvInterface
{
    public function getInvoiceAmount();
    public function getPayedAmount();
    public function getInvoiceDate();
    public function getInvoiceCode();
    public function getAccountNumber();
}
