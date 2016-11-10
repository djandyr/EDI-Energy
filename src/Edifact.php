<?php

namespace Proengeno\EdiEnergy;

use Proengeno\EdiEnergy\Configuration;
use Proengeno\Edifact\Templates\AbstractMessage;

abstract class Edifact extends AbstractMessage
{
    protected function getSegmentObject($segLine)
    {
        return parent::getSegmentObject(
            call_user_func_array($this->configuration->getOutputCharsetConverter(), [$segLine])
        );
    }
}
