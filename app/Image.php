<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    /**
     * 获得这张图片的所用评论。每张图片可对应多条评论
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }

    /**
     * 获得这张图片的所有标签
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
