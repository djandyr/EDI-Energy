<?php

namespace Proengeno\EdiEnergy\Interfaces;

interface MsconsStornoInterface extends AddressInterface
{
    public function getOriginalMessageCode();
    public function getMeterpoint();
}
