@extends('layouts.app')

@section('title', '创建')

@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
<style type="text/css">
    * {
        font-family: Raleway,"PingFang SC",sans-serif;
    }

    .list-inline > li:first-child a::before {
        content: '←\a0';
        left: -1.2em;
    }

    .list-inline > li {
        font-size: 2rem;
    }

    .post-wrapper {
        margin-bottom: 3.5em;
    }
</style>
@endpush

@section('content')
<div class="container">
    <header class="text-center">
        <h1>创建博客</h1>
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
        <div class="col-md-12 post-wrapper">
            <form action="{{ url('post/save') }}" method="POST" id="submit_form">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="post_title">标题</label>
                    <input type="text" maxlength="25" class="form-control" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="post_body">内容</label>
                    <textarea class="form-control" id="body" rows="3" name="body"></textarea>
                </div>
                <div class="form-group">
                    <label for="post_tags">标签</label>
                    <select class="form-control" id="tags" name="tags[]" multiple>
                        <option value="" disabled>-- 请选择 --</option>
                        @foreach ($tags as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">提交</button>
            </form>
        </div>
        <div class="clearfix"></div>
        <footer class="text-center">
            <p>&copy; 2017 ;)</p>
        </footer>
    </main>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('.navbar').hide();

    var form = document.getElementById('submit_form');
    var simplemde = new SimpleMDE({ element: document.getElementById("body") });
    var postbody = document.getElementById('body');
    form.addEventListener('submit', function submitForm(event) {
        event.preventDefault();
        postbody.value = simplemde.value();
        form.submit();
    });

});
</script>
@endpush