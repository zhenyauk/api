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


    protected function getUid()
    {
        $token = JWTAuth::getToken();
        if(!$token){
            return response()->json('invalid token');
        }
        $user = JWTAuth::toUser($token);
        return $user->id;
    }

    protected function getUser()
    {
        $token = JWTAuth::getToken();
        if(!$token){
            return response()->json('invalid token');
        }
        $user = JWTAuth::toUser($token);
        return $user;
    }

    protected function secure($name)
    {
        $name = strip_tags($name);
        $name = htmlentities($name, ENT_QUOTES, "UTF-8");
        $name = htmlspecialchars($name, ENT_QUOTES);
        return $name;
    }

}
