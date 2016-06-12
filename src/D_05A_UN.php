<?php

namespace Proengeno\EdiMessages;

use Proengeno\Edifact\Message\EdifactFile;
use Proengeno\Edifact\Templates\AbstractMessage;

abstract class D_05A_UN extends AbstractMessage
{
    public static function fromString($string)
    {
        $file = new EdifactFile('php://temp', 'w+');
        $file->writeAndRewind($string);
        return new static($file);
    }
}
