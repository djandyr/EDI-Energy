<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd\Consumer\Supplier;

use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface SupllierSignOffResponseInterface extends ResponseInterface
{
    public function getIdeRef();
    public function getSupplierSignOffDate();
    public function getCustomerSignOffDate();
    public function getContractTermDate();
    public function getNoticePeriod();
    public function getComments();
    public function getMeterpoint();
}
