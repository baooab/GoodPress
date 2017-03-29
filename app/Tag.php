<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $dates = ['deleted_at'];

    /**
     * 获得使用了这个标签的所有博客
     */
    public function posts()
    {
        return $this->morphedByMany('App\Post', 'taggable');
    }

    /**
     * 获得使用了这个标签的所有图片
     */
    public function images()
    {
        return $this->morphedByMany('App\Tag', 'taggable');
    }
}
