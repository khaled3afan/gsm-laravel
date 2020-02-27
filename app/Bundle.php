<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Order;
use App\Service;
use App\ServiceCode;
use App\ServiceType;

class Bundle extends Model
{
    use softDeletes;
    protected $fillable= [
        'name',
        'price',
        'service_id',
        'bundletype_id'
    ];

    public function orders() {
        return $this->belongsToMany(Order::class);
    }

    public function service() {
        return $this->belongsTo(Service::class);
    }

    public function bundle_codes() {
        return $this->hasMany(ServiceCode::class);
    }

    public function bundletype() {
        return $this->belongsTo(ServiceType::class);
    }
}
