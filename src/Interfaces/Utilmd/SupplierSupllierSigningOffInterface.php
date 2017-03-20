<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd;

use Proengeno\EdiEnergy\Interfaces\FullAddressInterface;

interface SupplierSupllierSigningOffInterface extends FullAddressInterface
{
    public function getIdeRef();
    public function getComments();
    public function getMeterpoint();
    public function getMeterNumber();
    public function getContractStart();
    public function isFixedSignOff();
    public function getSignOffDate();
}
