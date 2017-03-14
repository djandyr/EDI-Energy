<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd;

interface SupplierCancellationInterface
{
    public function getIdeRef();
    public function getReason();
    public function getComments();
    public function getMeterpoint();
    public function getContractStart();
    public function getCancellationDate();
}
