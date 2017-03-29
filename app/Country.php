<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * 获得某个国家所有用户发布的博客。
    */
    public function posts() {
        return $this->hasManyThrough('App\Post', 'App\User');
    }
}
