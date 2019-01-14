<?php

namespace App\Http\Controllers\API;

use App\Log;
use App\Operation;
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
    public function edit_wallet(Request $request)
    {
        $request->has('currency') ? $currency =  $request->currency : $currency = 'rub';
        $uid = $this->getUid();
        if( $wallet = Wallet::where('user_id', $uid)->first() ){

        } else {
            $wallet = new Wallet;
            $wallet->user_id = $uid;
        }

        $wallet->wallet_address = $request->address;
        $wallet->currency = $currency;
        if( $wallet->save() ){
            return json_encode(['status' => 'success', 'wallet' => $wallet]);
        }
        return json_encode('error');
    }

    //use in current controller
    public function getWallet($uid)
    {
        if( $wallet = Wallet::where('user_id', $uid)->first() ){
        }else{
            $wallet = new Wallet;
            $wallet->user_id = $uid;
            $wallet->save();
        }
        return $wallet;
    }

    public function create_users_wallet()
    {
        $wallet = new Wallet;
        $wallet->user_id =  $this->getUid();
        if ( $wallet->save() ) return $wallet;
        return json_encode(['status' => 'error with wallet']);
    }

    //Add cash to wallet throught `operations`
    public function plus(Request $request)
    {
        //if( $op = Operation::where('hash', $request->hash) ){
        //    $this->logme();
        //    return "ERRORRRR";
        //}
        $wallet = $this->getWallet( $this->getUid() );
        $op = new Operation;
        $op->wallet_id = $wallet->id;
        $op->operation = 'plus';
        $op->amount = (int) $request->amount;
        $op->amount_cents = (int) $request->amount_cents;
        $op->info = $request->info;
        $op->log = "user = " . $this->getUid() . " "  ."wallet amount " . $wallet->amount . " " . $wallet->currency;
        $op->hash = $request->hash;
        //Apply operation to Wallet
        if( $op->save() ){
            $wallet->amount = $wallet->amount + $op->amount;
            $wallet->amount_cents = $wallet->amount_cents + (int) $op->amount_cents;
            $wallet->save();
            return $wallet;
        }
    }

    //Minus cash from wallet throught `operations`
    public function minus(Request $request)
    {
        //if( $op = Operation::where('hash', $request->hash) ){
        //    $this->logme();
        //    return "ERRORRRR";
        //}
        $wallet = $this->getWallet( $this->getUid() );
        $op = new Operation;
        $op->wallet_id = $wallet->id;
        $op->operation = 'minus';
        $op->amount = (int) $request->amount;
        $op->amount_cents = (int) $request->amount_cents;
        $op->info = $request->info ;
        $op->log = "user = " . $this->getUid() . " " . $request->all() ."wallet amount " . $wallet->amount . " " . $wallet->currency;
        //Apply operation to Wallet
        if( $op->save() ){
            $wallet->amount = $wallet->amount - $op->amount;
            $wallet->amount_cents = $wallet->amount_cents - (int) $op->amount_cents;
            $wallet->save();
            return $wallet;
        }
    }


    public function logme()
    {
        $log = new Log;
        $log->ip = $_SERVER['REMOTE_ADDR'];
        $log->type = 'security';
        $log->info = 'Попытка взлома и махинации с финансами... или просто баг с интернетом на стороне клиента!';
        $log->uid = $this->getUid();
        $log->save();
        return 'Errorrrr';
    }

}
