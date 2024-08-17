<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MealController extends Controller
{
    public function list_menu_items()
    {
        return ResponseHelper::returnResource(
            MealResource::collection(Meal::where('available_quantity','>',0)->paginate((int) request('per_page'))),
            'Success Return List Menu Items',
            true,
            Response::HTTP_OK
        );
    }
}
