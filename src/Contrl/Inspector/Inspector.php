<?php

namespace Proengeno\EdiEnergy\Contrl\Inspector;

use Proengeno\EdiEnergy\Configuration;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Contrl\ContrlPositiv;
use Proengeno\EdiEnergy\Contrl\ContrlFileError;

class Inspector
{
    private $message;

    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->message->rewind();
    }

    public static function fromString($string, Configuration $configuration)
    {
        return new static(Message::fromString($string, $configuration));
    }

    public static function fromFilepath($path, Configuration $configuration)
    {
        return new static(Message::fromFilepath($string, $configuration));
    }

    public function getContrlItem()
    {
        while ($seg = $this->message->getNextSegment()) {
            if ($seg->name() == 'UNB') {
                $unbRef = $seg->referenzNumber();
                $sender = $seg->sender();

                if (! $this->checkReceiver($seg) ) {
                    return new ContrlFileError($sender, $unbRef, ContrlFileError::INVALID_RECEIVER);
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
