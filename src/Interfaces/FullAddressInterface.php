<?php

namespace Proengeno\EdiEnergy\Interfaces;

interface FullAddressInterface extends AddressInterface
{
    public function getFirstName();
    public function getLastName();
    public function getCompany();
}
