<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestCollectionsController extends Controller
{
    public function index() {
        return "Test Collections Controller ;)";
    }

    public function all() {
        $this->dd(collect([1, 2, 3])->all());
    }

    public function avg() {
        $collection = collect([
            ['name' => 'JavaScript: The Good Parts', 'pages' => 176],
            ['name' => 'JavaScript: The Definitive Guide', 'pages' => 1096],
        ]);

        dd($collection->avg('pages'));
    }

    public function chunk() {
        $collection = collect([1, 2, 3, 4, 5, 6, 7]);
        $chunks = $collection->chunk(4);
        dd($chunks->toArray());
    }

    public function collapse() {
        $collection = collect([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
        $collapsed = $collection->collapse(); // 浅折叠
        dd($collapsed->all());
    }

    public function combine() {
        $collection = collect(['name', 'age']); // keys
        $combined = $collection->combine(['George', 29]); // 分别对应这里的值，这里的值作为 values
        dd($combined->all());
        // ['name' => 'George', 'age' => 29]
    }

    public function contains() {
        $collection = collect(['name' => 'Desk', 'price' => 100]);
        //dd($collection->contains('Desk'));
        // true
        //$collection->contains('New York');
        // false

        $collection = collect([
            ['product' => 'Desk', 'price' => '200'],
            ['product' => 'Chair', 'price' => 100],
        ]);
        // 内部使用 == 判断，所以可能会发生类型转换
        //dd($collection->contains('price', 200));
        // true
        //dd($collection->contains('product', 'Desk'));
        // true

        $collection = collect([1, 2, 3, 4, 5]);
        $contained = $collection->contains(function ($value, $key) {
            return $value > 4;
        });
        dd($contained);
        // true
    }

    public function count() {
        $collection = collect([1, 2, 3, 4]);
        $count = $collection->count();
        dd($count);
        // 4
    }

    public function diff() {
        $collection = collect([1, 2, 3, 4, 5]);
        // 列举出在 $collection 中存在，在 [2, 4, 6, 8] 不存在的项
        $diff = $collection->diff([2, 4, 6, 8]);
        dd($diff->all());
        // [1, 3, 5]
    }


}
