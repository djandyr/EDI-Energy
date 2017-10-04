<?php

namespace Proengeno\EdiEnergy\Interfaces\Mscons;

use Proengeno\EdiEnergy\Interfaces\AddressInterface;

interface MetercountTransmissionInterface extends AddressInterface
{
    public function getObis();
    public function getStartReadinDate();
    public function getEndReadingDate();
    public function getOrdersCode();
    public function getReportingPoint();
    public function getMeterNumber();
    public function getReadinReason();
    public function getReadinType();
    public function getReadingKind();
    public function getReadingAmount();
}
