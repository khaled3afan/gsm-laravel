<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;


class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
