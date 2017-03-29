@extends('layouts.app')

@section('title', $post->title)

@push('style')
<link rel="stylesheet" href="https://unpkg.com/@nishanths/zoom.js@2.0.1/css/zoom.css">
<style type="text/css">
    .list-inline > li:first-child a::before {
        content: '←\a0';
        left: -1.2em;
    }

    .list-inline > li {
        font-size: 2rem;
    }

/*    article > p {
        color: #000;
    }*/

    p + h1 {
        margin-top: .5em;
    }

    /* Custom Style */
    article > footer {
        margin-top: 1.5em;
        font-size: .85em;
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
            <header>
                <h1>{{ $post->title }}</h1>
                <p>{{ $post->updated_at->format('l h:ia, jS F Y') }}</p>
            </header>
                {!! $post->body !!}
            <footer>
                <p>标签：
                    @forelse ($post->tags as $tag)
                        <a href="{{ url('post/tag', ['id' => $tag->id]) }}">{{ $tag->name }}</a></li>
                    @empty
                        No tags
                    @endforelse</p>
                @if (Auth::user()->can('update', $post))
                    <p>操作：<a href="{{ url('post/edit', ['id' => $post->id]) }}">编辑</a></p>
                @endif
            </footer>
        </article>
        <div class="clearfix"></div>
        <footer class="text-center">
            <p>&copy; 2017 ;)</p>
        </footer>
    </main>
</div>
@endsection

@push('scripts')
<script type="text/javascript">
    $('img').attr('data-action', 'zoom')
            .addClass('img-responsive');
</script>
<script src="https://unpkg.com/@nishanths/zoom.js@2.0.1/dist/zoom.min.js"></script>
@endpush
