<?php

namespace Proengeno\EdiEnergy\Orders;

use Proengeno\EdiEnergy\EdifactBuilder;

abstract class OrdersBuilder extends EdifactBuilder
{
    const MESSAGE_SUBTYPE = '';
    const MESSAGE_TYPE = 'ORDERS';
    const ORGANISATION_CODE = '1.1g';
}
