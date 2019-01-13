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
        $wallet = Wallet::where('user_id', $uid)->first();
        return fractal($wallet, new WalletTransform);
    }
}
