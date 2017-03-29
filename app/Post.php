<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id', 'title', 'body',
    ];

    /**
     * 获得用户所有的博客。每个用户可以有多篇博客
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * 获得这篇博客的所用评论。每篇博客可对应多条评论
     */
    // public function comments() {
    //     return $this->hasMany('App\Comment');
    // }

    /**
     * 获得这篇博客的所用评论。每篇博客可对应多条评论
     */
    public function comments() {
        return $this->morphMany('App\Comment', 'commentable')->withTimestamps();
    }

    /**
     * 获得这篇博客的所有标签
     */
    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable')->withTimestamps();
    }

    public function getCreatedAtAttribute($date)
    {
        // 十天前的博客直接显示时间
        if (Carbon::now() > Carbon::parse($date)->addDays(10)) {
            return Carbon::parse($date);
        }

        return Carbon::parse($date)->diffForHumans();
    }
}
