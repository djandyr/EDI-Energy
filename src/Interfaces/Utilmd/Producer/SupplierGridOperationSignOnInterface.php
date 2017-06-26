<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd\Producer;

use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface SupplierGridOperationSignOnInterface
{
    public function getIdeRef();
    public function getReason();
    public function getSaleForm();
    public function getMeterpoint();
    public function getSignOnDate();
    public function getContractStart();
    public function getBalancingGroup();
    public function getDivisionPercent();
    public function getPaymentReceiver();
    public function getRemoteControlCapability();
}
