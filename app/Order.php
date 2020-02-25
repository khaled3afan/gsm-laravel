<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Service;
use App\Bundle;

class Order extends Model
{
    protected $fillable= [
        'title',
        'price',
        'info',
        'status',
        'response',
        'user_id'
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function services() {
        return $this->belongsToMany(Service::class);
    }

    public function bundles() {
        return $this->belongsToMany(Bundle::class);
    }
}
