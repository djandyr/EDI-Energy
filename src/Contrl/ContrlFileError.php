<?php

namespace Proengeno\EdiEnergy\Contrl;

use Proengeno\EdiEnergy\Interfaces\Contrl\ContrlInterface;

class ContrlFileError extends Contrl
{
    const STATUS_CODE = 4;

    public function __construct($unbRef)
    {
        parent::__construct(parent::VALIDATION_FILE_ERROR, self::STATUS_CODE, $unbRef);
    }
}
