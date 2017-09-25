<?php

namespace Proengeno\EdiEnergy\Interfaces\Remadv;

interface RejectedPaymentsInterface
{
    public function getAnswer();
    public function getComments();
    public function getInvoiceAmount();
    public function getInvoiceDate();
    public function getInvoiceCode();
    public function getAccountNumber();
}
