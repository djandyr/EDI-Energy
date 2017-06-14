<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd;

use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface SupplierNoBalancingChangeRequestInterface
{
    public function getIdeRef();
    public function getContractStart();
    public function getChangesStart();
    public function hasMarketAreaChange();
    public function getMarketArea();
    public function hasDeliveryNameChange();
    public function getFirstName();
    public function getLastName();
    public function hasDeliveryCompanyChange();
    public function getCompany();
    public function hasDeliveryAddressChange();
    public function getStreet();
    public function getStreetNo();
    public function getCity();
    public function getZip();
    public function getMeterpoint();
}
