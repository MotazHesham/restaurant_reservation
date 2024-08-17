<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'table_id' => $this->table_id,
            'reservation_id' => $this->reservation_id, 
            'customer' => CustomerResource::make($this->customer), 
            'waiter' => UserResource::make($this->user), 
            'total' => round($this->total,2), 
            'paid' => $this->paid, 
            'date' => $this->date,
            'details' => OrderDetailResource::collection($this->orderDetails),
        ];
    }
}
