<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd\Supplier;

use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface SupllierSignOffDeniedResponseInterface extends ResponseInterface
{
    public function getIdeRef();
    public function getSupplierSignOffDate();
    public function getCustomerSignOffDate();
    public function getContractTermDate();
    public function getNoticePeriod();
    public function getComments();
    public function getMeterpoint();
}
