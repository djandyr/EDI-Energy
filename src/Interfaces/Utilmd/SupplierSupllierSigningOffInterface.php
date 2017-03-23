<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd;

use Proengeno\EdiEnergy\Interfaces\FullAddressInterface;
use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface SupplierSupllierSigningOffInterface extends FullAddressInterface, ResponseInterface
{
    public function getIdeRef();
    public function getReason();
    public function getComments();
    public function getMeterpoint();
    public function getMeterNumber();
    public function isFixedSignOff();
    public function getSignOffDate();
    public function getAnnualConsumption();
}
