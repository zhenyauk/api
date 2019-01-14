<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use JWTAuth;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //return User $user->id
    protected function getUid()
    {
        $user = $this->getUser();
        return $user->id;
    }

    //return User $user
    protected function getUser()
    {
        $token = JWTAuth::getToken();
        if(!$token){
            return response()->json('invalid token');
        }
        $user = JWTAuth::toUser($token);
        return $user;
    }

    //Make your get\post more secure
    protected function secure($name)
    {
        $name = strip_tags($name);
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        $name = htmlspecialchars($name, ENT_QUOTES);
        return $name;
    }

}
