<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Transformers\UserTransform;
class UserController extends Controller
{
    public function user()
    {
        $user = $this->getUser();
        return fractal($user, new UserTransform);

    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|min:4|max:100'
        ]);
        $user = User::findOrFail( $this->getUid() );
        $user->password = Hash::make($request->passowrd);
        if($user->save()) return json_encode(['status'=> 'success']);
        return json_encode('some thing wrong...');
    }

    public function changeUser(Request $request)
    {

        $user = User::findOrFail( $this->getUid() );
        $user->email = $request->email;
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->bill_number = $request->bill_number;
        $user->phone_number = $request->phone_number;

        if( $user->save() )  return fractal($user, new UserTransform);
        return json_encode('some thing wrong...');
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
