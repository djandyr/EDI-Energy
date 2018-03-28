<?php

namespace Proengeno\EdiEnergy\Utilmd;

use DateTime;
use Proengeno\EdiEnergy\EdifactBuilder;

abstract class UtilmdBuilder extends EdifactBuilder
{
    const MESSAGE_SUBTYPE = '';
    const RELEASE_NUMBER = '11A';
    const MESSAGE_TYPE = 'UTILMD';
    const ORGANISATION_CODE = '5.1g';

    public function getDescriptionPath()
    {
        return __DIR__ . '/U' . $this::CHECK_DIGIT . '/UtilmdU' . $this::CHECK_DIGIT . '.php';
    }

    protected function writeMessage($items)
    {
        $this->writeSeg('Unh', [
            $this->unbReference(),
            $this->description->get('versions.message_type'),
            $this->description->get('versions.version_number'),
            $this->description->get('versions.release_number'),
            $this->description->get('versions.organisation'),
            $this->description->get('versions.organisation_code'),
        ]);
        $this->writeSeg('Bgm', [$this->bgmType, $this->unbReference()]);
        $this->writeSeg('Dtm', [137, new DateTime, 203]);
        $this->writeSeg('Nad', ['MS', $this->from, $this->getNadQualifier($this->from)], 'fromMpCode');
        $this->writeSeg('Cta', ['IC', $this->description->get('contact.name')]);
        $this->writeSeg('Com', [$this->description->get('contact.phone'), 'TE']);
        $this->writeSeg('Com', [$this->description->get('contact.email'), 'EM']);
        $this->writeSeg('Nad', ['MR', $this->to, $this->getNadQualifier($this->to)], 'fromMpCode');

        foreach ($items as $item) {
            $this->writeItem($item);
        }

        $this->writeSeg('Unt', [$this->unhCount() + 1, $this->unbReference()]);
    }
}
