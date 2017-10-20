<?php

namespace Proengeno\EdiEnergy\Contrl\Inspector;

use Proengeno\EdiEnergy\Contrl\ContrlFileError;
use Proengeno\Edifact\Templates\AbstractSegment as Segment;

class FileErrorInspector
{
    protected $sender;
    protected $receiver;
    protected $unbRef;

    public function __construct($sender, $receiver, $unbRef)
    {
        $this->sender = $sender;
        $this->receiver = $receiver;
        $this->unbRef = $unbRef;
    }

    public function checkSegment($seg)
    {
        if (!$this->segmentNeedsCheck($seg)) {
            return null;
        }

        if ($this->receiverIsInvalid($seg)) {
            return new ContrlFileError($this->sender, $this->unbRef, ContrlFileError::INVALID_RECEIVER);
        }

        return null;
    }

    private function segmentNeedsCheck($seg)
    {
        if ($seg->name() === 'UNB') {
            return true;
        }

        return false;
    }

    private function receiverIsInvalid($seg)
    {
        if ($this->receiver == $seg->receiver()) {
            return false;
        }

        return true;
    }
}
