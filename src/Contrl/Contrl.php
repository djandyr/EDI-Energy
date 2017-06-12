<?php

namespace Proengeno\EdiEnergy\Contrl;

use Proengeno\EdiEnergy\Interfaces\Contrl\ContrlInterface;

class Contrl implements ContrlInterface
{
    const VALIDATION_OK = 'valid';
    const VALIDATION_FILE_ERROR = 'file_error';
    const VALIDATION_MESSAGE_ERORR = 'message_error';

    private $statusCode;
    private $unbRef;

    public function __construct($statusCode, $unbRef)
    {
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
}
