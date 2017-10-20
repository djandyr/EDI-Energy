<?php

namespace Proengeno\EdiEnergy\Contrl;

use Proengeno\EdiEnergy\Interfaces\Contrl\ContrlInterface;

class ContrlFileError extends Contrl
{
    const STATUS_CODE = 4;
    const INVALID_RECEIVER = 7;

    private $uciCode;
    private $serviceSegement;
    private $segmentPosition;
    private $elementPosition;

    public function __construct($receiver, $unbRef, $uciCode, $segmentPosition = null, $elementPosition = null)
    {
        parent::__construct($receiver, parent::VALIDATION_FILE_ERROR, self::STATUS_CODE, $unbRef);

        $this->setUciCode($uciCode);
        $this->segmentPosition = $segmentPosition;
        $this->elementPosition = $elementPosition;
    }

    public function getUciCode()
    {
        return $this->uciCode;
    }

    public function getServiceSegement()
    {
        return $this->serviceSegement;
    }

    private function setUciCode($uciCode)
    {
        $this->uciCode = $uciCode;
        $this->serviceSegement = 'UNB';
    }
}
