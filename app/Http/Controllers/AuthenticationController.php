<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseHelper;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{

    public function login(LoginRequest $request): JsonResponse|JsonResource
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            $token = $user->createToken('user')->plainTextToken;
            $user->token = $token;

            return ResponseHelper::returnResource(
                UserResource::make($user),
                'Success',
                true,
                Response::HTTP_OK
            );
        }

        return ResponseHelper::returnResponse(
            null,
            'user credentials doesn\'t exists',
            false,
            Response::HTTP_UNAUTHORIZED
        );
    }
}
