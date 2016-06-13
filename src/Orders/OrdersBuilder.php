<?php

namespace Proengeno\EdiEnergy\Orders;

use Proengeno\EdiEnergy\D_05A_UN_Builder as Builder;

abstract class OrdersBuilder extends Builder
{
    const MESSAGE_SUBTYPE = '';
    const MESSAGE_TYPE = 'ORDERS';
    const ORGANISATION_CODE = '1.1g';
}
