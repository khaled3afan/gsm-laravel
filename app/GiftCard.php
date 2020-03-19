<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiftCard extends Model
{
    protected $fillable=[
        'card',
        'user_id',
        'status',
        'value'
    ];

    public function user() {
        return $this->belongsTo(App\User::class);
    }
}
