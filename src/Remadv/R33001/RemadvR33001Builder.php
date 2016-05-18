<?php

namespace Proengeno\EdiMessages\Remadv\R33001;

use DateTime;
use Proengeno\EdiMessages\Remadv\Remadv;
use Proengeno\Edifact\Message\Segments\Unh;
use Proengeno\Edifact\Message\Segments\Bgm;
use Proengeno\Edifact\Message\Segments\Dtm;
use Proengeno\Edifact\Message\Segments\Rff;
use Proengeno\Edifact\Message\Segments\Nad;
use Proengeno\Edifact\Message\Segments\Cux;
use Proengeno\Edifact\Message\Segments\Doc;
use Proengeno\Edifact\Message\Segments\Moa;
use Proengeno\Edifact\Message\Segments\Unt;
use Proengeno\EdiMessages\Builder_D_05A_UN as Builder;

class RemadvR33001Builder extends Builder
{
    const MESSAGE_SUBTYPE = '';
    const MESSAGE_TYPE = 'REMADV';
    const ORGANISATION_CODE = '2.7b';
    const DOC_CODE = 481;
    const CHECK_DIGIT = 33001;

    private $energyType;

    public function __construct($from, $to, $mode = 'w+')
    {
        parent::__construct(RemadvR33001::class, $from, $to, $mode);
    }

    protected function writeMessage($items)
    {
        $this->writeUnhHead();
        foreach ($items as $item) {
            $this->writeUnhBody($item);
        }
        $this->writeUnhFoot();
    }

    private function writeUnhHead()
    {
        $this->writeSegment(Unh::fromAttributes(
            $this->unbReference(), 
            self::MESSAGE_TYPE,
            self::VERSION_NUMBER,
            self::RELEASE_NUMBER, 
            self::ORGANISATION,
            self::ORGANISATION_CODE
        ));
        $this->writeSegment(Bgm::fromAttributes(self::DOC_CODE, $this->unbReference()));
        $this->writeSegment(Dtm::fromAttributes(137, new DateTime, 102));
        $this->writeSegment(Rff::fromAttributes('Z13', self::CHECK_DIGIT));
        $this->writeSegment(Nad::fromMpCode('MS', $this->from, 293));
        $this->writeSegment(Nad::fromMpCode('MR', $this->to, 293));
        $this->writeSegment(Cux::fromAttributes(2, 'EUR', 4));
    }

    private function writeUnhBody($item)
    {
        $this->writeSegment(Doc::fromAttributes($item->getInvoiceCode(), $item->getAccountNumber()));
        $this->writeSegment(Moa::fromAttributes(9, $item->getAmount()));
        $this->writeSegment(Dtm::fromAttributes(137, $item->getInvoiceDate(), 102));
    }
    
    private function writeUnhFoot()
    {
        $this->writeSegment(Unt::fromAttributes($this->unhCounter, $this->unbReference()));
    }
}
