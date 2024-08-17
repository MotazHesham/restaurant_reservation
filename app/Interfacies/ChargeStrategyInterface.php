<?php

namespace App\Interfacies;

interface ChargeStrategyInterface
{
    public function calcTotal(float $total): float; 
}