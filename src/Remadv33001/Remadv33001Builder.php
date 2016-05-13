<?php

namespace Proengeno\EdiMessages\Remadv33001;

use DateTime;
use Proengeno\Edifact\Message\Builder;
use Proengeno\Edifact\Message\Segments\Unb;

class Remadv33001Builder extends Builder
{
    protected $messageType = 'REMADV';
    protected $messageSubType = '';

    private $energyType;

    public function __construct($from, $to, $mode = 'w+')
    {
        parent::__construct(Remadv33001::class, $from, $to, $mode);
    }

    protected function getMessage($array)
    {
        return null;
    }

    protected function getUnb()
    {
        return Unb::fromAttributes('UNOC', 3, $this->from, 500, $this->to, 500, new DateTime(), $this->unbReference(), $this->messageSubType);
    }
}
