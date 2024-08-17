<?php

namespace App\PaymentMethods;

use App\Interfacies\ChargeStrategyInterface; 

class TaxServiceStrategy implements ChargeStrategyInterface
{
    public function calcTotal(float $total): float
    {
        
        $tax = $total * 0.14;
        $service = $total * 0.20;
        return $total + $tax + $service;
    } 
}