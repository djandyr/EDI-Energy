<?php

namespace Proengeno\EdiEnergy\Utilmd\U11183;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;

class UtilmdU11183Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11183;

    protected $bgmType = 'Z35';

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11183Description.php';
    }

    protected function writeItem($item)
    {
        $this->writeSeg('Ide', ['24', $item->getIdeRef()]);
        $this->writeSeg('Imd', ['Z14', 'Z07']);
        $this->writeSeg('Sts', ['7', 'ZJ7']);
        $this->writeSeg('Loc', ['172', $item->getMeterpoint()]);
        $this->writeSeg('RFF', ['Z13', self::CHECK_DIGIT]);

        $this->writeSeg('Seq', ['Z01']);
        $this->writeSeg('Rff', ['AVE', $item->getMeterpoint()]);
        $this->writeSeg('Cci', ['Z15', 'Z30']);
    }
}
