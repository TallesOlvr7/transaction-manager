<?php

namespace App\Services;
use App\Http\Requests\AuthLoginRequest;
use Auth;
use Illuminate\Foundation\Auth\User;
class AuthService
{
    public function __construct(
        protected UserService $userService,
    )
    {}
    public function login(AuthLoginRequest $request):bool
    {
        if(!Auth::attempt($request->validated())){
            return false;
        }
        return true;
    }

    public function generateToken(User $loggedUser):string
    {
        $userType = $this->userService->getType($loggedUser);
        if($userType === 'Customer'){
            return $loggedUser->createToken('token',['transaction:make'])->plainTextToken;
        }
        return $loggedUser->createToken('token')->plainTextToken;
    }
}