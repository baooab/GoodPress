<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * 获得手机的主人。每部手机对应一个用户
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
