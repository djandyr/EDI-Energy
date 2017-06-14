<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd;

use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface SupplierNoBalancingChangeInterface
{
    public function getIdeRef();
    public function getContractStart();
    public function getChangesStart();
    public function hasNameChange();
    public function getFirstName();
    public function getLastName();
    public function hasCompanyChange();
    public function getCompany();
    public function getMeterpoint();
}
