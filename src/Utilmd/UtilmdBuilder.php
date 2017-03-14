<?php

namespace Proengeno\EdiEnergy\Utilmd;

use DateTime;
use Proengeno\EdiEnergy\EdifactBuilder;

abstract class UtilmdBuilder extends EdifactBuilder
{
    const MESSAGE_SUBTYPE = '';
    const RELEASE_NUMBER = '11A';
    const MESSAGE_TYPE = 'UTILMD';
    const ORGANISATION_CODE = '5.1f';
}
