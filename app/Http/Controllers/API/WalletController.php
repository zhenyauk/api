<?php

namespace App\Http\Controllers\API;

use App\Transformers\WalletTransform;
use App\User;
use App\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WalletController extends Controller
{
    // Get Wallet by Bearer token
    public function wallet()
    {
        $uid = $this->getUid();
        if( $wallet = Wallet::where('user_id', $uid)->first() ) return fractal($wallet, new WalletTransform);
        return $this->create_users_wallet();
    }


    //require $currency, address
    public function create_wallet(Request $request)
    {
        $request->has('currency') ? $currency =  $request->currency : $currency = 'rub';
        $uid = $this->getUid();
        $wallet = new Wallet;
        $wallet->user_id = $uid;
        $wallet->wallet_address = $request->address;
        $wallet->currency = $currency;
        if( $wallet->save() ){
            return json_encode(['status' => 'success', 'wallet' => $wallet]);
        }
        return json_encode('error');
    }

    public function create_users_wallet(Request $request)
    {
        $wallet = new Wallet;
        $wallet->user_id =  $this->getUid();
        if ( $wallet->save() ) return $wallet;
        return json_encode(['status' => 'error with wallet']);
    }
}
