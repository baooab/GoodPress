@extends('layouts.app')

@section('title', '首页')

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

    /* see http://stackoverflow.com/questions/10555175/css-last-child-on-html5-article */
    article:last-of-type {
        margin-bottom: 3.5em;
    }

/*    article > p {
        color: #000;
    }*/

    p + h1 {
        margin-top: .5em;
    }

    /* Custom Style */
    article + article {
        margin-top: 1.5em;
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
        @forelse ($posts as $post)
            <article class="col-md-8 col-md-offset-2 post">
                <header>
                    <!-- <p>{{ $post->updated_at->format('l h:ia, jS F Y') }}</p> -->
                    {{ $post->created_at }}
                    <h1><a href="{{ url('post/show', ['id' => $post->id]) }}" title="{{ $post->title }}">{{ $post->title }}</a></h1>
                </header>
                {!! $post->body !!}
                <p class="text-right"><a href="{{ url('post/show', ['id' => $post->id]) }}" title="{{ $post->title }}">详情 &raquo;</a></p>
            </article>
        @empty
            <div class="col-md-12">
                <p class="text-center">No posts</p>
            </div>
        @endforelse
        <article class="col-md-2 col-md-offset-2">
            {{ $posts->links('custom.pagination.defaultpost') }}
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