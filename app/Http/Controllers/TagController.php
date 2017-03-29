<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $this->authorize('view', Tag::class);

        $tags = Tag::withTrashed()->latest()->paginate(15);
        return view('tag.index', [
            'tags' => $tags,
        ]);
    }

    // update tag name
    public function update(Request $request) {
        $this->validate($request, [
            'id' => 'required',
            'name' => 'required|unique:tags',
        ]);

        $id = $request->input('id');
        $name = $request->input('name');

        $tag = Tag::findOrFail($id);
        $updated = $tag->update([
            'name' => $request->input('name'),
        ]);

        return response()->json([
            'successed' => ($updated ? true : false),
            'message' => 'update successfully!'
        ]);
    }

    public function create() {
        $this->authorize('view', Tag::class);

        $tags = Tag::select('id', 'name')->get();

        return view('tag.create', [
            'tags' => $tags,
        ]);
    }

    public function save(Request $request) {
        $this->validate($request, [
            'tags' => 'required',
        ]);

        // If there's a tag owning the name, do nothing
        // If no matching model exists, create one.
        $tags = $request->input('tags');
        $updateOrCreateRow = 0;
        foreach ($tags as $tag) {
            Tag::updateOrCreate(['name' => $tag], ['name' => $tag]);
            $updateOrCreateRow++;
        }
        $successed = ($updateOrCreateRow === count($tags));
        $message = $successed ? 'update successfully!' : 'update error!';

        return response()->json([
            'successed' => $successed,
            'message' => $message,
        ]);
    }

    public function delete(Request $request) {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $id = $request->input('id');
        $deleted = Tag::destroy($id) ? true : false;
        $message = $deleted ? 'delete successfully!' : 'deleted error!';

        return response()->json([
            'successed' => $deleted,
            'message' => $message,
        ]);
    }

    public function restore(Request $request) {
        $this->validate($request, [
            'id' => 'required',
        ]);

        $id = $request->input('id');
        $restored = (Tag::where('id', $id)->restore()) ? true : false;
        $message = $restored ? 'restore successfully!' : 'restore error!';

        return response()->json([
            'successed' => $restored,
            'message' => $message,
        ]);
    }
}
