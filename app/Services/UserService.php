<?php

namespace App\Services;
use \Illuminate\Foundation\Auth\User;
use Auth;

class UserService
{
    public function getType(User $user):string
    {
        return $user->type;
    }
}