@extends('layouts.app')

@section('title', '创建')

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

    .image-wrapper, .pre-look-image-wrapper {
        margin-bottom: 3.5em;
    }
</style>
@endpush

@section('content')
<div class="container">
    <header class="text-center">
        <h1>创建</h1>
        <nav>
            <ul class="list-inline">
                <li><a href="{{ url('') }}" title="返回到站点首页">返回</a></li>
                <li><a href="{{ url('image') }}" title="进入图集主页">主页</a></li>
                <li><a href="{{ url('image/popular') }}" title="查阅最受欢迎的图片">最受欢迎</a></li>
                <li><a href="{{ url('image/tags') }}" title="进入图集标签列表页">标签</a></li>
            </ul>
        </nav>
    </header>
    <main class="row">
        <div class="col-md-12 image-wrapper">
            <form action="{{ url('image/upload') }}" method="POST" id="submit_form" enctype="multipart/form-data">

                {{ csrf_field() }}

                <div class="form-group">
                    <label for="post_title">标题</label>
                    <input type="text" maxlength="25" class="form-control" id="image_title" name="post_title">
                </div>
                <div class="form-group file-wrapper">
                    <label for="image_url">URL</label><small> 或 <a href="javascript:void(0);" class="file-wrapper-toggle">上传文件</a></small>
                    <input class="form-control" id="image_url" rows="3" name="image_url">
                </div>
                <div class="form-group file-wrapper" style="display: none;">
                    <label for="image_file">选择文件</label><small> 或 <a href="javascript:void(0);" class="file-wrapper-toggle">输入URL</a></small>
                    <input class="form-control" id="images" rows="3" name="images[]" type="file" multiple>
                    <p class="help-block">最大 2MB</p>
                </div>
                <a href="javascript:void(0);" class="btn btn-primary btn-lg btn-block btn-submit">创建</a>
            </form>
        </div>
        <div class="col-md-8 col-md-offset-2 pre-look-image-wrapper">
            <img id="pre_look_image" src="https://placeholdit.imgix.net/~text?txtsize=33&txt=%E5%9B%BE%E7%89%87%E9%A2%84%E8%A7%88%E5%8C%BA&w=780&h=150" class="img-responsive" data-action="zoom">
        </div>
        <div class="clearfix"></div>
        <footer class="text-center">
            <p>&copy; 2017 ;)</p>
        </footer>
    </main>
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/@nishanths/zoom.js@2.0.1/dist/zoom.min.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var form = document.getElementById('submit_form');
    var imageURLInput = document.getElementById('image_url');
    var $imageURLInput = $(imageURLInput);
    var preImage = document.getElementById('pre_look_image');
    var $preImage = $(preImage);
    var $submitButton = $('.btn-submit');
    var $fileWrapper = $('.file-wrapper');
    var fileWrapperToggle = $('.file-wrapper-toggle');
    var $preLookImageWrapper = $('.pre-look-image-wrapper');

    var Helper = {};
    // helper function for updaing images via ajax
    Helper.upload_images = function upload_images(formData) {
        $.ajax({
            url: "{{ url('image/upload') }}",
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        })
        .done(function (msg) {
                if (msg.successed) {
                    var urls = msg.urls;
                    for (var i = urls.length - 1; i >= 0; i--) {
                        imageURLInput.value = imageURLInput.value + urls[i].path + ',';
                        $preLookImageWrapper.append('<p><a target="_blank" href="{{ asset('storage') }}/'+urls[i].path+'">'+ urls[i].originName +'</a> 上传成功！'+urls[i].path+'</p>');
                    }

                    $imageURLInput.attr('readonly', true);

                    $fileWrapper.toggle();
                    $submitButton.toggleClass('btn-primary btn-info');
                    if ($submitButton.hasClass('btn-submit')) {
                        $imageURLInput.attr('readonly', false);
                        $imageURLInput.val('');

                        $preImage.hide();
                        $submitButton.text('上传');
                        $submitButton.addClass('btn-upload').removeClass('btn-submit');
                    } else {
                        $preImage.show();
                        $submitButton.text('创建');
                        $submitButton.addClass('btn-submit').removeClass('btn-upload');
                    }
                }
            })
            .fail(function (err) {
                alert('err:' + JSON.stringify(err.responseText));
            });
    }

    // $('.btn-submit').on('click', function submitForm(event) {
    //     event.preventDefault();
    //     form.submit();
    // });


    $(form).on('click', '.btn-upload', function submitForm(event) {
        event.preventDefault();
        event.stopPropagation();

        // see http://blog.teamtreehouse.com/uploading-files-ajax
        var fileSelect = document.getElementById('images');
        var files = fileSelect.files;
        var formData = new FormData();
        var file = null;
        for (var i = 0; i < files.length; i++) {
            file = files[i];
            if (file.type.indexOf('image') === -1) {
                continue;
            }
            formData.append('images[]', file, file.name);
        }

        Helper.upload_images(formData);
    });

    fileWrapperToggle.on('click', function toggleFile(event) {

        $fileWrapper.toggle();
        $submitButton.toggleClass('btn-primary btn-info');
        if ($submitButton.hasClass('btn-submit')) {
            $imageURLInput.attr('readonly', false);
            $imageURLInput.val('');

            $preImage.hide();
            $submitButton.text('上传');
            $submitButton.addClass('btn-upload').removeClass('btn-submit');
        } else {
            $preImage.show();
            $submitButton.text('创建');
            $submitButton.addClass('btn-submit').removeClass('btn-upload');
        }
    })

    $(imageURLInput).on('input', function setImage(event) {
        if (isURL(this.value)) {
            preImage.src = this.value;
            return ;
        }
        preImage.src = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=%E5%9B%BE%E7%89%87%E9%A2%84%E8%A7%88%E5%8C%BA&w=780&h=150';
    });

    // see http://www.soulteary.com/2014/12/05/better-url-regexp-in-js.html
    function isURL(str) {
        return !!str.match(/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/g);
    }
</script>
@endpush