<?php

namespace Proengeno\EdiEnergy\Contrl\Inspector;

use Proengeno\EdiEnergy\Configuration;
use Proengeno\Edifact\Message\Message;
use Proengeno\EdiEnergy\Contrl\ContrlPositiv;
use Proengeno\EdiEnergy\Contrl\ContrlFileError;
use Proengeno\EdiEnergy\Contrl\Inspector\FileErrorInspector;

class Inspector
{
    private $message;
    private $unbRef;
    private $sender;

    public function __construct(Message $message)
    {
        $this->message = $message;
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
        $this->setSender();
        $this->setUnbRef();

        $fileErrorInspector = new FileErrorInspector($this->sender, $this->message->getConfiguration('exportSender'), $this->unbRef);

        $this->message->rewind();
        while ($seg = $this->message->getNextSegment()) {
            if ($contrlFileError = $fileErrorInspector->checkSegment($seg)) {
                return $contrlFileError;
            }
        }

        return new ContrlPositiv($this->sender, $this->unbRef);
    }

    private function setSender()
    {
        if ($unb = $this->message->findSegmentFromBeginn('UNB')) {
            $this->sender = $unb->sender();
        }
    }

    private function setUnbRef()
    {
        if ($unb = $this->message->findSegmentFromBeginn('UNB')) {
            $this->unbRef = $unb->referenzNumber();
        }
    }

    private function checkReceiver($seg)
    {
        if ($this->message->getConfiguration('exportSender') == $seg->receiver()) {
            return true;
        }

        return false;
    }
}
