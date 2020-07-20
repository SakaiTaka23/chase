<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{

    protected $fillable = [
        'place',
    ];

    public function user()
    {
        return $this->hasMany('App/User');
    }
}
