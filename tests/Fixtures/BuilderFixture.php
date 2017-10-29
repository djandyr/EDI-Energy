<?php

namespace Proengeno\EdiEnergy\Test\Fixtures;

use Proengeno\EdiEnergy\EdifactBuilder;

class BuilderFixture extends EdifactBuilder
{
    const MESSAGE_TYPE = 'TEST';
    const ORGANISATION_CODE = 'VERSION';
    const MESSAGE_SUBTYPE = 'SUB_TYPE';

    public function getDescriptionPath()
    {
        return __DIR__ . '/BuilderFixtureDescription.php';
    }

    public function testWriteUnb()
    {
        $this->writeUnb();
    }

    public function getFileContent()
    {
        return (string)$this->edifactFile;
    }

    protected function writeMessage($item)
    {
        //
    }
}
