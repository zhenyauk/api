<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function user()
    {
        return $this->getUser();
    }

    public function userId()
    {
        return $this->getUid();
    }

    public function wallet()
    {
        $uid = $this->getUid();
        return User::findOrFail($uid)->wallet();
    }

    public function markeplace()
    {
        $uid = $this->getUid();
        return User::findOrFail($uid)->marketplace();
    }
}
