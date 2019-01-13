<?php

namespace App\Transformers;

use App\Wallet;
use League\Fractal\TransformerAbstract;

class WalletTransform extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Wallet $wallet)
    {
        return [
            'wallet' => $wallet->wallet_address,
            'amount' => $wallet->amount,
            'amount_cents' => $wallet->amount_cents,
        ];
    }
}
