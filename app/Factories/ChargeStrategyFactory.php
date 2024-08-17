<?php
namespace App\Factories;

use App\Interfacies\ChargeStrategyInterface;
use App\PaymentMethods\ServiceOnlyStrategy; 
use App\PaymentMethods\TaxServiceStrategy;
use Illuminate\Support\Facades\App;

class ChargeStrategyFactory
{ 
    public static function create(string $chargeType): ChargeStrategyInterface
    {
        $strategyClass = self::getStrategyClass($chargeType);

        if (!class_exists($strategyClass)) {
            throw new \InvalidArgumentException("Invalid Payment type: {$chargeType}.");
        }

        $strategy = App::make($strategyClass);

        if (!$strategy instanceof ChargeStrategyInterface) {
            throw new \InvalidArgumentException("The strategy class must implement ChargeStrategyInterface.");
        }

        return $strategy;
    }

    private static function getStrategyClass(string $chargeType): string
    { 
        $className = str_replace(' ', '', ucwords(str_replace('_', ' ', $chargeType))) . 'Strategy';
        
        return "App\\PaymentMethods\\{$className}";
    }
}
