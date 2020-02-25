<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;
use App\Bundle;
class ServiceType extends Model
{
    protected $fillable= ['name'];

    public function services() {
        return $this->hasMany(Service::class);
    }
    public function bundels() {
        return $this->hasMany(Bundle::class);
    }
}
