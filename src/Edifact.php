<?php

namespace Proengeno\EdiEnergy;

use Proengeno\EdiEnergy\Configuration;
use Proengeno\Edifact\Message\EdifactFile;
use Proengeno\Edifact\Templates\AbstractMessage;

abstract class Edifact extends AbstractMessage
{
    public static function fromString($string, Configuration $configuration = null)
    {
        $file = new EdifactFile('php://temp', 'w+');
        $file->writeAndRewind($string);

        return new static($file, $configuration);
    }

    protected function getSegmentObject($segLine)
    {
        return parent::getSegmentObject(
            call_user_func_array($this->configuration->getOutputCharsetConverter(), [$segLine])
        );
    }
}
