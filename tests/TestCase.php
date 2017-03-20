<?php

namespace Proengeno\EdiEnergy\Test;

use Mockery as m;
use Proengeno\EdiEnergy\Configuration;
use Proengeno\Edifact\EdifactRegistrar;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected $edifactObject;
    protected $configuration;

    protected function setUp()
    {
        $this->configuration = new Configuration;
        $this->configuration->setExportSender('from');

        m::getConfiguration()->allowMockingNonExistentMethods(false);
    }

    protected function tearDown()
    {
        if ($this->edifactObject) {
            @unlink($this->edifactObject->getFilepath());
        }
        m::close();
    }
}
