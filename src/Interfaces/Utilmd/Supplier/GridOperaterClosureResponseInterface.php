<?php

namespace Proengeno\EdiEnergy\Interfaces\Utilmd\Supplier;

use Proengeno\EdiEnergy\Interfaces\ResponseInterface;

interface GridOperaterClosureResponseInterface extends ResponseInterface
{
    public function getIdeRef();
    public function getComments();
    public function getMeterpoint();
    public function getSignOffDate();
    public function getBalancingEnd();
}
