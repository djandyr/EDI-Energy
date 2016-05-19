<?php

namespace Proengeno\EdiMessages\Remadv\R33001;

use DateTime;
use Proengeno\Edifact\Message\Segments\Dtm;
use Proengeno\Edifact\Message\Segments\Doc;
use Proengeno\Edifact\Message\Segments\Moa;
use Proengeno\Edifact\Message\Segments\Uns;
use Proengeno\Edifact\Message\Segments\Unt;
use Proengeno\EdiMessages\Remadv\RemadvBuilder;
use Proengeno\EdiMessages\Remadv\RemadvInterface;

class RemadvR33001Builder extends RemadvBuilder
{
    const DOC_CODE = 481;
    const CHECK_DIGIT = 33001;

    private $sumAmount;

    public function __construct($from, $to, $mode = 'w+')
    {
        parent::__construct(RemadvR33001::class, $from, $to, $mode);
    }

    protected function writeUnhBody(RemadvInterface $item)
    {
        $this->writeSegment(Doc::fromAttributes($item->getInvoiceCode(), $item->getAccountNumber()));
        $this->writeSegment(Moa::fromAttributes(9, $item->getAmount()));
        $this->writeSegment(Moa::fromAttributes(12, $item->getAmount()));
        $this->writeSegment(Dtm::fromAttributes(137, $item->getInvoiceDate(), 102));

        $this->sumAmount += $item->getAmount();
    }
    
    protected function writeUnhFoot()
    {
        $this->writeSegment(Uns::fromAttributes());
        $this->writeSegment(Moa::fromAttributes(12, $this->sumAmount));
        $this->writeSegment(Unt::fromAttributes($this->unhCounter, $this->unbReference()));
    }
}
