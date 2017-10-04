<?php

namespace Proengeno\EdiEnergy\Mscons;

use Proengeno\EdiEnergy\EdifactBuilder;

abstract class MsconsBuilder extends EdifactBuilder
{
    const RELEASE_NUMBER = '04B';
    const MESSAGE_TYPE = 'MSCONS';
    const ORGANISATION_CODE = '2.2h';
}
