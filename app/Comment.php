<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content', 'commentable_id', 'commentable_type',
    ];

    protected $hidden = [
        'post_id', 'updated_at', 'commentable_id', 'commentable_type',
    ];

    /**
     * 获得这条评论评论的博客。每条评论对应一篇博客
     */
    // public function post()
    // {
    //     return $this->belongsTo('App\Post');
    // }

    /**
     * 获得这条评论评论的博客。每条评论对应一个 Model 实例（博客或图片）
    */
    public function commentable()
    {
        return $this->morphTo();
    }
}
