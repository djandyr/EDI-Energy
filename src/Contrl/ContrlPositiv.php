<?php

namespace Proengeno\EdiEnergy\Contrl;

use Proengeno\EdiEnergy\Interfaces\Contrl\ContrlInterface;

class ContrlPositiv extends Contrl
{
    const STATUS_CODE = 7;

    public function __construct($unbRef)
    {
        parent::__construct(self::STATUS_CODE, $unbRef);
    }
}
