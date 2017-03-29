<?php

namespace App\Http\Controllers;

use App\Tag;
use App\Post;
use App\User;
use App\Taggable;
use Parsedown;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $posts = Auth::user()->posts()->latest()->simplePaginate(5);
        $posts->map(function ($post, $index) {
            $post->body = $this->cut_markdown_str($post->body);
            $post->body = (new Parsedown())->text($post->body);
            return $post;
        });

        return view('post.index', [
            'posts' => $posts,
        ]);
    }

    public function create() {
        $tags = Tag::get();

        return view('post.create', [
            'tags' => $tags,
        ]);
    }

    public function save(Request $request) {
        $this->validate($request, [
            'title' => 'required|unique:posts|max:25',
            'body' => 'required',
        ]);

        $tags = $request->input('tags');
        $tagged = $this->is_tagged($tags);

        $post = new Post([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);
        $post->user()->associate(User::findOrFail(1));

        // save Post & Post's tags
        $saved = $post->save();
        if ($saved && $tagged) {
            // always return `null`
            $post->tags()->attach($tags);
        }

        return redirect('post');
    }

    public function delete($id) {
        return redirect('post');
    }

    public function edit($id) {
        $post = Post::with('tags')->findOrFail($id);

        // Determine whether the user can edit the post.
        $this->authorize('update', $post);

        $tags = Tag::get();
        $post->tags = $post->tags->map(function ($tag, $key) {
            return $tag->id;
        })->toArray();

        return view('post.edit', [
            'post' => $post,
            'tags' => $tags,
        ]);
    }

    public function update(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'title' => 'required|max:25',
            'body' => 'required',
        ]);

        $post = Post::findOrFail($request->input('id'));

        // Determine whether the user can update the post.
        $this->authorize('update', $post);

        $tags = $request->input('tags');
        $tagged = $this->is_tagged($tags);

        // update Post & Post's tags
        $updated = $post->update([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);
        if ($updated && $tagged) {
            // always return `null`
            $post->tags()->sync($tags);
        }

        Log::info('User ' . Auth::user()->id .' updated post '. $post->id);

        return redirect('post');
    }

    public function show($id) {
        $post = Post::with('tags')->findOrFail($id);
        $post->body = (new Parsedown())->text($post->body);

        return view('post.show', [
            'post' => $post,
        ]);
    }

    // get posts below a tag of the authenticated user
    public function tagposts($tagid) {

        // the tag be searched
        $tag = Tag::findOrFail($tagid);

        // find all post's ids below the searched tag's id
        $taggables = Taggable::where('taggable_type', '=', 'post')
                        ->where('tag_id', '=', $tagid)
                        ->select('taggable_id')
                        ->get();
        $postids = $taggables->map(function ($taggable, $index) {
            return $taggable->taggable_id;
        })->toArray();

        // filter & get authenticated user's posts
        $posts= Auth::user()->posts()->whereIn('id', $postids)->simplePaginate(5);
        $posts->map(function ($post, $index) {
            $post->body = (new Parsedown())->text($post->body);
            return $post;
        });

        return view('post.tagposts', [
            'tag' => $tag,
            'posts' => $posts,
        ]);
    }

    public function popular() {
        return view('post.index');
    }

    // get all tags of the authenticated user
    public function tags() {

        // find user's all posts ids
        $posts = Auth::user()->posts()->select('id')->get();
        $postids = $posts->map(function ($post, $index) {
            return $post->id;
        })->toArray();

        // find all posts tag's id
        $taggables = Taggable::where('taggable_type', '=', 'post')
                        ->whereIn('taggable_id', $postids)
                        ->distinct('tag_id')
                        ->select('tag_id')
                        ->get();
        $tagids = $taggables->map(function ($taggable, $index) {
            return $taggable->tag_id;
        })->toArray();

        // find all posts tag list
        $tags = Tag::whereIn('id', $tagids)
                    ->get();

        return view('post.tags', [
            'tags' => $tags,
        ]);
    }

    private function is_tagged($tags) {
        return (null !== $tags) && is_array($tags) && (count($tags) > 0);
    }

    // slice markdown string
    private function cut_markdown_str($str, $rows = 6, $appendstr = '……'){
        $CODE_SYMBOL = '```';
        $orginarr = explode(PHP_EOL, $str);
        $temparr = array_slice($orginarr, 0, $rows);

        // if have, find the first code symbol index
        $hascode = false;
        $codeindex = -1;
        $anothercodeindex = -1;
        foreach ($temparr as $index => $tempelem) {
            if (strpos($tempelem, $CODE_SYMBOL) === 0) {
                $hascode = true;
                $codeindex = $index;
                break;
            }
        }

        // if have the first code symbol, then find another code symbol index
        if ($hascode) {
            foreach ($orginarr as $index => $originelem) {
                if ($index === $codeindex) {
                    continue;
                }
                if (strpos($originelem, $CODE_SYMBOL) === 0) {
                    $anothercodeindex = $index;
                    break;
                }
            }
        }

        // slice markdown string again for code situation outside the default settings
        if ($anothercodeindex >= $rows) {
            $temparr = array_slice($orginarr, 0, ($anothercodeindex + 1));
        }

        //return implode(PHP_EOL, $temparr) . PHP_EOL . $appendstr;
        return implode(PHP_EOL, $temparr);
    }

}
