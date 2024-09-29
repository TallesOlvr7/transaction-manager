<?php

namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Services\AuthService;
use Auth;
use Illuminate\Http\JsonResponse;
class AuthController extends Controller
{
    public function __construct(
       protected AuthService $authService,
    )
    {}
    public function auth(AuthLoginRequest $request):JsonResponse
    {
        if(!$this->authService->login($request)){
            return response()->json([
                'status'=>false,
                'message'=>'Unauthorized'
            ],404);
        }

        $loggedUser = Auth::user();
        $token = $this->authService->generateToken($loggedUser);
        return response()->json([
            'status'=>true,
            'messsage'=>'Authorized',
            'token'->$token
        ],200);
    }
}

