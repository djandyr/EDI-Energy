<?php

namespace Proengeno\EdiEnergy;

use Proengeno\Edifact\Message\SegmentDescription;
use Proengeno\Edifact\Templates\AbstractSegment as OriginSegment;

class AbstractSegment  extends OriginSegment
{
    // Have to override, cause PHP5.5 doesnt work with
    // dot-concatenation in Class Signature
    public static function meta()
    {
        return SegmentDescription::make(__DIR__ . '/Segments/' . static::$jsonDescribtion);
    }
}
