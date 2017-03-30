<?php

namespace Proengeno\EdiEnergy\Utilmd\U11004;

class UtilmdU11004ItemMapper
{
    private $items = [];

    public static function parse($edifactObject)
    {
        $item = [];
        foreach ($edifactObject as $segment) {
            $methodName = ucfirst(strtolower($segment->name())) . 'ToItem';
            echo $methodName;
            exit;
        }
    }
}
