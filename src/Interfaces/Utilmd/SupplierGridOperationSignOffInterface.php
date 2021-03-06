<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd;

use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface SupplierGridOperationSignOffInterface
{
    public function getIdeRef();
    public function getReason();
    public function getComments();
    public function getMeterpoint();
    public function getContractStart();
    public function getSignOffDate();
}
