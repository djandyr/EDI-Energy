<?php

namespace Proengeno\EdiEnergy;

use Proengeno\Edifact\Message\EdifactFile;
use Proengeno\Edifact\Templates\AbstractMessage;

abstract class Edifact extends AbstractMessage
{
    public static function fromString($string)
    {
        $file = new EdifactFile('php://temp', 'w+');
        $file->writeAndRewind($string);
        return new static($file);
    }

    protected function getSegmentObject($segLine)
    {
        if (isset($this->configuration['convertCharset'])) {
            $segLine = $this->configuration['convertCharset']($segLine);
        }
        return parent::getSegmentObject($segLine);
    }
}
