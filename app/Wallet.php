<?php

namespace App;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function userName()
    {
        return $this->belongsTo(User::class)->name();
    }
}
