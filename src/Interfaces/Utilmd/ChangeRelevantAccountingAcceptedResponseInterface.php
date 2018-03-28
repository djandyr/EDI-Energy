<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd;

use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface ChangeRelevantAccountingAcceptedResponseInterface extends ResponseInterface
{
    public function getIdeRef();
    public function getContractStart();
    public function getChangesStart();
    public function getSaleForm();
    public function getBalancingGroup();
    public function getMeterpointType();
}
