<?php

namespace Proengeno\EdiMessages\Remadv;

use DateTime;
use Proengeno\Edifact\Message\Segments\Unh;
use Proengeno\Edifact\Message\Segments\Bgm;
use Proengeno\Edifact\Message\Segments\Dtm;
use Proengeno\Edifact\Message\Segments\Nad;
use Proengeno\Edifact\Message\Segments\Cux;
use Proengeno\Edifact\Message\Segments\Rff;

use Proengeno\EdiMessages\Builder_D_05A_UN as Builder;

abstract class RemadvBuilder extends Builder
{
    const MESSAGE_SUBTYPE = '';
    const MESSAGE_TYPE = 'REMADV';
    const ORGANISATION_CODE = '2.7b';

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
        $this->writeSegment(Bgm::fromAttributes(static::DOC_CODE, $this->unbReference()));
        $this->writeSegment(Dtm::fromAttributes(137, new DateTime, 102));
        $this->writeSegment(Rff::fromAttributes('Z13', static::CHECK_DIGIT));
        $this->writeSegment(Nad::fromMpCode('MS', $this->from, $this->getMpCodeQualifier('nad', $this->from)));
        $this->writeSegment(Nad::fromMpCode('MR', $this->to, $this->getMpCodeQualifier('nad', $this->to)));
        $this->writeSegment(Cux::fromAttributes(2, 'EUR', 11));
    }
}
