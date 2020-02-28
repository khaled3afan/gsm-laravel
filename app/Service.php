<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Category;
use App\ServiceCode;
use App\ServiceType;
use App\Bundle;
use App\Order;
class Service extends Model
{
    use SoftDeletes;
    protected $fillable= [
        'title',
        'description',
        'content',
        'category_id',
        'servicetype_id',
        'image',
        'price',
        'real_price',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function service_codes() {
        return $this->hasMany(ServiceCode::class);
    }
    public function servicetype() {
        return $this->belongsTo(ServiceType::class);
    }
    public function bundles() {
        return $this->hasMany(Bundle::class);
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
