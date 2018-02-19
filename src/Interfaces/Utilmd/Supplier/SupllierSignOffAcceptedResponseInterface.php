<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd\Supplier;

use Proengeno\EdiEnergy\Interfaces\FullAddressInterface;
use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface SupllierSignOffAcceptedResponseInterface extends FullAddressInterface, ResponseInterface
{
    public function getIdeRef();
    public function getMeterpoint();
    public function getMeterNumber();
    public function isFixedSignOff();
    public function getSignOffDate();
    public function getAnnualConsumption();
}
