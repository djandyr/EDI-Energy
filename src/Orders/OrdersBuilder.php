<?php

namespace Proengeno\EdiMessages\Orders;

use Proengeno\EdiMessages\D_05A_UN_Builder as Builder;

abstract class OrdersBuilder extends Builder
{
    const MESSAGE_SUBTYPE = '';
    const MESSAGE_TYPE = 'ORDERS';
    const ORGANISATION_CODE = '1.1g';
}
