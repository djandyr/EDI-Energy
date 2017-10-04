<?php

namespace Proengeno\EdiEnergy\Contrl;

use Proengeno\EdiEnergy\Interfaces\Contrl\ContrlInterface;

abstract class Contrl implements ContrlInterface
{
    const VALIDATION_OK = 'valid';
    const VALIDATION_FILE_ERROR = 'file_error';
    const VALIDATION_MESSAGE_ERORR = 'message_error';

    private $statusCode;
    private $unbRef;

    public function __construct($validationType, $statusCode, $unbRef)
    {
        $this->setValidationType($validationType);
        $this->statusCode = $statusCode;
        $this->unbRef = $unbRef;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getUnbReference()
    {
        return $this->unbRef;
    }

    private function setValidationType($validationType)
    {
        if ($validationType !== self::VALIDATION_OK
            && $validationType !== self::VALIDATION_FILE_ERROR
            && $validationType !== self::VALIDATION_MESSAGE_ERORR) {

            throw new \Exception('Unknow Validation-Type');
        }

        $this->validationType = $validationType;
    }
}
