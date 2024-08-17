<?php

namespace App\Enums;

enum ChargeTypeEnum: string
{
    case ServiceOnly= 'service_only';

    case TaxService = 'tax_service';
}
