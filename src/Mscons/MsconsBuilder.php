<?php

namespace Proengeno\EdiEnergy\Mscons;

use Proengeno\EdiEnergy\D_05A_UN_Builder as Builder;

abstract class MsconsBuilder extends Builder
{
    const MESSAGE_TYPE = 'MSCONS';
    const ORGANISATION_CODE = '2.2f';
}
