<?php

namespace Proengeno\EdiMessages\Remadv_33001;

use Proengeno\Edifact\Message\Builder as BuilderCore;

class Builder extends BuilderCore
{
    protected $messageType = 'REMADV';
    protected $messageSubType = '';

    private $energyType;

    protected function getMessage($array)
    {
        return null;
    }

    protected function getUnb()
    {
        return Unb::fromAttributes('UNOC', 3, $this->from, 500, $this->to, 500, new DateTime(), $this->unbReference(), $this->messageSubType);
    }
}
