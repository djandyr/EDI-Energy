<?php

namespace Proengeno\EdiEnergy\Interfaces;

interface MsconsVlInterface extends AddressInterface
{
    public function getObis();
    public function getFrom();
    public function getUntil();
    public function getOrdersCode();
    public function getMeterpoint();
    public function getMeterNumber();
    public function getReadinReason();
    public function getReadinType();
    public function getReadingKind();
    public function getReadingAmount();
}
