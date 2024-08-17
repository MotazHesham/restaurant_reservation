<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckAvailabilityTableRequest;
use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TableController extends Controller
{
    public function check_availability(CheckAvailabilityTableRequest $request): JsonResponse
    { 
        return ResponseHelper::returnResponse(
            ['is_available' => true],
            'Table is Available',
            true,
            Response::HTTP_OK
        );
    }
}
