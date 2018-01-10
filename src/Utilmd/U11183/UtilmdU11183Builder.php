<?php

namespace Proengeno\EdiEnergy\Utilmd\U11183;

use DateTime;
use Proengeno\EdiEnergy\Utilmd\UtilmdBuilder;

class UtilmdU11183Builder extends UtilmdBuilder
{
    const CHECK_DIGIT = 11183;

    public function getDescriptionPath()
    {
        return __DIR__ . '/UtilmdU11183Description.php';
    }

    protected function writeMessage($items)
    {
        $this->writeSeg('Unh', [
            $this->unbReference(),
            $this->description->get('versions.message_type-bl'),
            $this->description->get('versions.version_number'),
            $this->description->get('versions.release_number'),
            $this->description->get('versions.organisation'),
            $this->description->get('versions.organisation_code'),
        ]);
        $this->writeSeg('Bgm', ['Z35', $this->unbReference()]);
        $this->writeSeg('Dtm', [137, new DateTime, 203]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', 'Herr Geerdes']);
        $this->writeSeg('Com', ['04958 91570-10', 'TE']);
        $this->writeSeg('Com', ['j.geerdes@proengeno.de', 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');

        foreach ($items as $item) {
            $this->writeItem($item);
        }

        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }

    private function writeItem($item)
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
