<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;
use App\Bundle;
class ServiceCode extends Model
{
    protected $fillable= ['code', 'service_id', 'bundle_id', 'user_id', 'status'];

    public function service() {
        return $this->belongsTo(Service::class);
    }
    public function bundle() {
        return $this->belongsTo(Bundle::class);
    }
}
