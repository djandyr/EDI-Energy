<?php

namespace Proengeno\EdiEnergy\Contrl\Inspector;

use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Contrl\ContrlPositiv;
use Proengeno\EdiEnergy\Contrl\ContrlFileError;

class Inspector
{
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getContrlItem()
    {
        if (! $this->checkReceiver() ) {
            return new ContrlFileError('UNB_REF');
        }

        return new ContrlPositiv('UNB_REF');
    }

    private function checkReceiver()
    {
        $unb = $this->message->findSegmentFromBeginn('UNB');

        if ($this->message->getConfiguration('exportSender') == $unb->receiver()) {
            return true;
        }

        return false;
    }
}
