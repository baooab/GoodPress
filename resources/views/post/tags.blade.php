@extends('layouts.app')

@section('title', '标签')

@push('style')
<style type="text/css">
    .list-inline > li:first-child a::before {
        content: '←\a0';
        left: -1.2em;
    }

    .list-inline > li {
        font-size: 2rem;
    }

    /* see http://stackoverflow.com/questions/10555175/css-last-child-on-html5-article */
    article:last-of-type {
        margin-bottom: 3.5em;
    }

    article > p {
        color: #000;
    }

    p + h1 {
        margin-top: .5em;
    }
</style>
@endpush

@section('content')
<div class="container">
    <header class="text-center">
        <!-- <h1>张宝</h1> -->
        <nav>
            <ul class="list-inline">
                <li><a href="{{ url('') }}" title="返回到站点首页">返回</a></li>
                <li><a href="{{ url('post') }}" title="进入博客主页">主页</a></li>
                <li><a href="{{ url('post/popular') }}" title="查阅最受欢迎的博客">最受欢迎</a></li>
                <li><a href="{{ url('post/tags') }}" title="进入博客标签列表页">标签</a></li>
            </ul>
        </nav>
    </header>
    <main class="row">
        <article class="col-md-8 col-md-offset-2 post">
            <p>博客标签列表：</p>
            <ul>
                @foreach($tags as $tag)
                    <li><a href="{{ url('post/tag', ['tagid' => $tag->id]) }}" title="{{ $tag->name }}">{{ $tag->name }}</a></li>
                @endforeach
            </ul>
        </article>
        <div class="clearfix"></div>
        <footer class="text-center">
            <p>&copy; 2017 ;)</p>
        </footer>
    </main>
</div>
@endsection