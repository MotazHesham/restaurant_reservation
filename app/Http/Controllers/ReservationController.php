<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ReserveTableRequest;
use App\Http\Resources\ReservationResource;
use App\Models\Customer;
use App\Models\Reservation;
use App\Models\Table;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function reserve_table(ReserveTableRequest $request) :JsonResource|JsonResponse
    {  

        DB::beginTransaction();
        try{
            // Lock The Table Just in case There is Two Waiters Reserve the table ...
            $table = Table::where('id', $request->table_id)->lockForUpdate()->first();

            $customer = Customer::firstOrCreate($request->only('name','phone'));

            $reservation = Reservation::create([
                'table_id' => $table->id, 
                'customer_id' => $customer->id,   
                'from_time' => $request->from_time, 
                'to_time' => $request->to_time, 
            ]);

            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            return ResponseHelper::returnResponse(null,$ex->getMessage(),false,Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return ResponseHelper::returnResource(ReservationResource::make($reservation),'Table Reserved Successfully',true,Response::HTTP_OK);
    }
}
