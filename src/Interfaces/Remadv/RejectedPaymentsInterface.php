<?php

namespace Proengeno\EdiEnergy\Interfaces\Remadv;

interface RejectedPaymentsInterface extends PaymentsInterface
{
    public function getAnswer();
    public function getComments();
}
