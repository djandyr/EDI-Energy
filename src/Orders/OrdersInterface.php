<?php

namespace Proengeno\EdiEnergy\Orders;

interface OrdersInterface
{
    public function getType();
    public function getCode();
    public function getStreet();
    public function getStreetNumber();
    public function getCity();
    public function getZip();
    public function getMeterpoint();
    public function getFrom();
    public function getUntil();
}
