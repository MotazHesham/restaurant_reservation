<?php

namespace App\Http\Controllers;

use App\Factories\ChargeStrategyFactory; 
use App\Helpers\ResponseHelper;
use App\Http\Requests\CheckoutRequest;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Reservation;
use App\Services\OrderService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    protected $orderService; 

    public function __construct(OrderService $orderService){
        $this->orderService = $orderService;
    }
    public function order(OrderRequest $request)
    {
        $order = $this->orderService->storeOrder($request->reservation_id,$request->meals);

        return ResponseHelper::returnResource(
            OrderResource::make($order),
            'Order created successfully',
            true,
            Response::HTTP_OK
        );
    }

    public function pay(CheckoutRequest $request)
    {
        $order = $this->orderService->pay($request->order_id,$request->charge_type); 
        
        return ResponseHelper::returnResource(
            OrderResource::make($order),
            'Order Paid successfully',
            true,
            Response::HTTP_OK
        );
    }
}
