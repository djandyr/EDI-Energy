<?php

namespace Proengeno\EdiEnergy\Interfaces;

interface OrdersInterface extends AddressInterface
{
    public function getType();
    public function getCode();
    public function getMeterpoint();
    public function getFrom();
    public function getUntil();
}
