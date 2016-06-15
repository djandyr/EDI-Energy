<?php

namespace Proengeno\EdiEnergy\Interfaces;

interface AddressInterface
{
    public function getStreet();
    public function getStreetNumber();
    public function getCity();
    public function getZip();
}
