<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 获得用户的手机。每个用户有一部手机
     */
    public function phone()
    {
        return $this->hasOne('App\Phone');
    }

    /**
     * 获得用户所有的博客。每个用户可以有多篇博客
     */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
     * 获得这个用户所有的角色。一个用户可以有多个角色
     */
    public function roles()
    {
        return $this->belongsToMany('App\Role')->withTimestamps();
    }

}
