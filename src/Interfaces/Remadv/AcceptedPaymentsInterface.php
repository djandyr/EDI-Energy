<?php

namespace Proengeno\EdiEnergy\Interfaces\Remadv;

interface AcceptedPaymentsInterface extends PaymentsInterface
{
    public function getPayedAmount();
}
