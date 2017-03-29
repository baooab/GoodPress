<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    /**
     * 获得拥有这个角色所有的用户。一个角色可以对应多个用户
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
