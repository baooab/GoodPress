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

    /* Custom Style */
    section + section {
        margin-top: .5em;
    }

    .page-footer {
        margin-top: 3.5em;
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
                <li><a href="{{ url('image') }}" title="进入图集主页">主页</a></li>
                <li><a href="{{ url('image/popular') }}" title="查阅最受欢迎的图片">最受欢迎</a></li>
                <li><a href="{{ url('image/tags') }}" title="进入图集标签列表页">标签</a></li>
            </ul>
        </nav>
    </header>
    <section class="row">
        <div class="col-md-8 col-md-offset-2">
            <article id="generic_carousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="http://image.wufazhuce.com/FuJ7LNrgBwwQvJLQSd4e1zEO3tBS" alt="" />
                    </div>
                    <div class="item">
                        <img src="http://www.ruanyifeng.com/images_pub/pub_345.jpg" alt="" />
                    </div>
                </div><!-- END div.carousel-inner -->
                <a class="left carousel-control" href="#generic_carousel" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">前一张图片</span>
                </a>
                <a class="right carousel-control" href="#generic_carousel" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">后一张图片</span>
                </a>
            </article>
        </div>
    </section>
    <section class="row">
        <div class="col-md-4 col-md-offset-2">
            <img src="http://image.wufazhuce.com/FuJ7LNrgBwwQvJLQSd4e1zEO3tBS" alt="..." class="img-rounded img-responsive lazy" data-action="zoom">
        </div>
        <div class="col-md-4">
            <img data-original="http://image.wufazhuce.com/FuJ7LNrgBwwQvJLQSd4e1zEO3tBS" alt="..." class="img-rounded img-responsive lazy" data-action="zoom">
        </div>
    </section>
    <section class="row">
        <div class="col-md-4 col-md-offset-2">
            <img data-original="http://image.wufazhuce.com/FuJ7LNrgBwwQvJLQSd4e1zEO3tBS" alt="..." class="img-rounded img-responsive lazy" data-action="zoom">
        </div>
        <div class="col-md-4">
            <img data-original="http://image.wufazhuce.com/FuJ7LNrgBwwQvJLQSd4e1zEO3tBS" alt="..." class="img-rounded img-responsive lazy" data-action="zoom">
        </div>
    </section>
    <section class="row">
        <div class="col-md-2 col-md-offset-5">
            <nav aria-label="image's pagination">
                <ul class="pager">
                    <li class="previous"><a href="#">←之前</a></li>
                    <li class="next"><a href="#">之后→</a></li>
                </ul>
            </nav>
        </div>
    </section>
    <footer class="text-center page-footer">
        <p>&copy; 2017 ;)</p>
    </footer>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/@nishanths/zoom.js@2.0.1/dist/zoom.min.js"></script>
<script src="{{ asset('js/jquery.lazyload.js') }}"></script>
<script type="text/javascript">
    $("img.lazy").lazyload();
</script>
@endpush