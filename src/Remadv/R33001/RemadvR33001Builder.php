<?php

namespace Proengeno\EdiMessages\Remadv\R33001;

use DateTime;
use Proengeno\Edifact\Message\Builder;
use Proengeno\EdiMessages\Remadv\Remadv;
use Proengeno\Edifact\Message\Segments\Unb;
use Proengeno\Edifact\Message\Segments\Unh;
use Proengeno\Edifact\Message\Segments\Bgm;
use Proengeno\Edifact\Message\Segments\Dtm;
use Proengeno\Edifact\Message\Segments\Rff;
use Proengeno\Edifact\Message\Segments\Nad;
use Proengeno\Edifact\Message\Segments\Cux;
use Proengeno\Edifact\Message\Segments\Doc;
use Proengeno\Edifact\Message\Segments\Moa;

class RemadvR33001Builder extends Builder
{
    protected $messageType = 'REMADV';
    protected $messageSubType = '';
    protected $versionNumber = 'D';
    protected $releaseNumber = '05A';
    protected $organisation = 'UN';
    protected $organisationCode = '2.7b';
    protected $docCode = 481;
    protected $checkId = 33001;

    private $energyType;

    public function __construct($from, $to, $mode = 'w+')
    {
        parent::__construct(RemadvR33001::class, $from, $to, $mode);
    }

    protected function getUnb()
    {

        return Unb::fromAttributes('UNOC', 3, $this->from, 500, $this->to, 500, new DateTime(), $this->unbReference(), $this->messageSubType);
    }

    protected function getMessage($items)
    {
        $this->writeUnhHead();
        foreach ($items as $item) {
            $this->writeUnhBody($item);
        }
    }

    private function writeUnhBody($item)
    {
        $this->edifactFile->write(
            Doc::fromAttributes($item->getInvoiceCode(), $item->getAccountNumber())
          . Moa::fromAttributes(9, $item->getAmount())
          . Dtm::fromAttributes(137, $item->getInvoiceDate(), 102)
        );
    }
    
    private function writeUnhHead()
    {
        $this->writeSegment(Unh::fromAttributes(
                $this->unbReference(), 
                $this->messageType, 
                $this->versionNumber, 
                $this->releaseNumber, 
                $this->organisation, 
                $this->organisationCode
        ));
        $this->writeSegment(Bgm::fromAttributes($this->docCode, $this->unbReference()));
        $this->writeSegment(Dtm::fromAttributes(137, new DateTime, 102));
        $this->writeSegment(Rff::fromAttributes('Z13', $this->checkId));
        $this->writeSegment(Nad::fromMpCode('MS', $this->from, 293));
        $this->writeSegment(Nad::fromMpCode('MR', $this->to, 293));
        $this->writeSegment(Cux::fromAttributes(2, 'EUR', 4));
    }
}
