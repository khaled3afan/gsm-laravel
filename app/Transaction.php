<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Wallet;
class Transaction extends Model
{
    protected $fillable= [
        'wallet_id',
        'transaction',
        'balance_after',
        'sender_id',
        'info',
        'note'
    ];

    public function wallet() {
        return $this->belongsTo(Wallet::class);
    }
}
