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

    public function __construct($receiver, $validationType, $statusCode, $unbRef)
    {
        $this->receiver = $receiver;
        $this->setValidationType($validationType);
        $this->statusCode = $statusCode;
        $this->unbRef = $unbRef;
    }

    public function getReceiver()
    {
        return $this->receiver;
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getUnbReference()
    {
        return $this->unbRef;
    }

    public function getValidationType()
    {
        return $this->validationType;
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
