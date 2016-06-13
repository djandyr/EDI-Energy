<?php

namespace Proengeno\EdiEnergy\Test;

use Mockery as m;
use Proengeno\Edifact\EdifactRegistrar;

abstract class TestCase extends \PHPUnit_Framework_TestCase
{
    protected function tearDown()
    {
        m::close();
    }
}
