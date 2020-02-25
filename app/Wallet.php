<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Transaction;
class Wallet extends Model
{
    protected $fillable=[
        'user_id',
        'balance'
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}
