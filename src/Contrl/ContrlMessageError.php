<?php

namespace Proengeno\EdiEnergy\Contrl;

use Proengeno\EdiEnergy\Interfaces\Contrl\ContrlInterface;

class ContrlMessageError extends Contrl
{
    const STATUS_CODE = 4;
    const INVALID_SENDER = 7;

    private $messageErrorDescription;

    public function __construct($receiver, $unbRef, $messageErrorDescription)
    {
        parent::__construct($receiver, parent::VALIDATION_MESSAGE_ERORR, self::STATUS_CODE, $unbRef);

        $this->messageErrorDescription = $messageErrorDescription;
    }
}
