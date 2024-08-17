<?php 

namespace App\Services;

use App\Enums\ChargeTypeEnum;
use App\Factories\ChargeStrategyFactory;
use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class OrderService{
    public function storeOrder(int $reservation_id, array $mealsId): Order
    {
        
        $reservation = Reservation::findOrFail($reservation_id); 

        $order = Order::create([
            'reservation_id' => $reservation->id,
            'customer_id' => $reservation->customer_id,
            'table_id' => $reservation->table_id,
            'user_id' => Auth::id(),
            'date' => date('Y-m-d'),
        ]);
        
        $fetchedMeals = Meal::whereIn('id',$mealsId)->get();
        
        $meals = [];
        $total = 0;
        foreach($fetchedMeals as $meal){
            $discountedPrice = $meal->price - (($meal->price * $meal->discount) / 100);
            $meals[] = [
                'order_id' => $order->id,
                'meal_id' => $meal->id,
                'amount_to_pay' => $discountedPrice,
            ];
            $total += $discountedPrice;
        }

        OrderDetail::insert($meals);

        $order->total = $total;
        $order->save();

        return $order;
    }

    public function pay(int $order_id, string $charge_type){
        
        $order = Order::findOrFail($order_id); 

        $chargeFactory = ChargeStrategyFactory::create($charge_type);
        $total = $chargeFactory->calcTotal($order->total);
        
        $order->paid = true;
        $order->total = $total;
        $order->save();
        
        return $order;
    }
}