<?php


namespace App\PaymentMethods;

use App\Interfacies\ChargeStrategyInterface; 

class ServiceOnlyStrategy implements ChargeStrategyInterface
{
    public function calcTotal(float $total): float
    {
        $service = $total * 0.15;
        return $total + $service;
    } 
}