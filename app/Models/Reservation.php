<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_id', 
        'customer_id',   
        'from_time', 
        'to_time', 
    ];

    public function scopeIsReserved(Builder $query,$from_time,$to_time)
    {  
        $query->whereBetween('from_time', [$from_time, $to_time])
            ->orWhereBetween('to_time', [$from_time, $to_time])
            ->orWhere(function ($query) use ($from_time, $to_time) {
                $query->where('from_time', '<=', $from_time)
                        ->where('to_time', '>=', $to_time);
            });  
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

}
