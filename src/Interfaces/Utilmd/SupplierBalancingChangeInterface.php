<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd;

use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface SupplierBalancingChangeInterface
{
    public function getIdeRef();
    public function getContractStart();
    public function getChangesStart();
    public function hasBalancingAreaChange();
    public function getBalancingArea();
    public function getMeterpoint();
    public function getMeterpointType();
}
