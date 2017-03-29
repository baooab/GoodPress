<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index() {
        return view('image.index');
    }

    public function create() {
        return view('image.create');
    }

    public function upload(Request $request) {
        $images = $request->file('images');
        $updatedRows = 0;
        $updateUrls = [];
        foreach ($images as $file) {
            if ($file->isValid()) {
                $originName = $file->getClientOriginalName();
                $originExt = $file->getClientOriginalExtension();
                $size = $file->getClientSize();

                // 存储路径，含新文件名。例如：'2017/01/586f2d753dfbd.jpg'
                $path = date('Y/m/') . uniqid() . '.' . $originExt;
                // 上传文件临时路径
                $realPath = $file->getRealPath();
                Storage::put($path, file_get_contents($realPath));

                $updateUrls[] = [
                    'originName' => $originName,
                    'originExt' => $originExt,
                    'size' => $size,
                    'path' => $path,
                ];

                $updatedRows++;
            }
        }

        $updated = (count($images) === $updatedRows) ? true : false;

        return response()->json([
            'successed' => $updated,
            'message' => 'update successfully!',
            'urls' => $updateUrls,
        ]);
    }

    public function save() {
        return redirect('image');
    }

    public function delete($id) {
        return redirect('image');
    }

    public function edit(Post $post) {
        return view('image.edit');
    }

    public function update() {
        return redirect('image');
    }

    public function show() {
        return view('image.show');
    }
}
