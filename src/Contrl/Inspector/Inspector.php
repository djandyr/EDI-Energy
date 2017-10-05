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
        while ($seg = $this->message->getNextSegment()) {
            if ($seg->name() == 'UNB') {
                $unbRef = $seg->referenzNumber();
                $sender = $seg->sender();

                if (! $this->checkReceiver($seg) ) {
                    return new ContrlFileError($sender, $unbRef, ContrlFileError::INVALID_SENDER);
                }
            }
        }

        return new ContrlPositiv($sender, $unbRef);
    }

    private function checkReceiver($seg)
    {
        if ($this->message->getConfiguration('exportSender') == $seg->receiver()) {
            return true;
        }

        return false;
    }
}
