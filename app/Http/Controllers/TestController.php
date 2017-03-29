<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Phone;
use App\Post;
use App\Comment;
use App\Role;
use App\Country;
use App\Tag;
use Parsedown;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index() {
        return 'Test Controller';
        // $roles = Auth::user()->roles()->get();
        // $roles =  $roles->map(function ($role) {
        //     return $role->name;
        // })->toArray();
        // var_dump(in_array('管理员', $roles));
    }

    public function oneToOne() {
        return User::find(1)->phone;
    }

    public function oneToOneInverse() {
        return Phone::find(1)->user;
    }

    public function oneToMany() {
        dd(Post::find(1)->comments);
    }

    public function oneToManyInverse() {
        dd(Comment::find(2)->post);
    }

    public function oneToMany2() {
        dd(User::find(1)->posts);
    }

    public function oneToManyInverse2() {
        dd(Post::find(2)->user);
    }

    public function manyToMany() {
        dd(User::find(1)->roles);
    }

    public function manyToManyInverse() {
        dd(Role::find(1)->users);
    }

    public function retrievingIntermediate() {
        $user = User::find(2);
        return $user->roles;
        // 取得用户-角色关系创建的时间
        foreach ($user->roles as $role) {
            echo $role->pivot->created_at;
            echo '<br>';
        }
    }

    public function hasManyThrough() {
        dd(Country::find(44)->posts);
    }

    public function polymorphicRelations() {
        return Post::find(1)->comments;
    }

    public function polymorphicRelationsInverse() {
        $Parsedown = new Parsedown();
        $comment = Comment::findOrFail(1);
        $commentable = $comment->commentable;
        if ($commentable instanceof Post) {
            $post = $commentable;
            $post->body = $Parsedown->text($post->body);
            return $post->body;
        }
        abort(404);
    }

    public function manyToManyPolymorphicRelations() {
        return Post::find(1)->tags;
    }

    public function manyToManyPolymorphicRelationsInverse() {
        dd(Tag::find(1)->posts);
    }
}
