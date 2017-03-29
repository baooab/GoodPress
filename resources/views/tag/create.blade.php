@extends('layouts.app')

@section('title', '创建 | 标签')

@section('content')
    <div class="container">
        <header class="text-center">
            <nav>
                <ul class="list-inline">
                    <li><a href="{{ url('tag') }}" title="进入标签主页">主页</a></li>
                    <li><a href="{{ url('tag/create') }}" title="创建标签">创建</a></li>
                </ul>
            </nav>
        </header>
        <div class="row" style="padding-top: 10em;">
            <div class="col-md-6 col-md-offset-2">
                <div class="form-group">
                    <div class="col-xs-8">
                        <select id="add_tags" class="form-control" multiple>
                            @forelse($tags as $tag)
                                <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="col-xs-4">
                        <button class="btn btn-primary btn-sm btn-block form-control btn-add">添加</button>
                    </div>
                </div>
            </div>
        </div>
<!--         <div class="row">
            <div class="col-md-6 col-md-offset-2">
                <div class="well">well</div>
            </div>
        </div> -->
    </div>
@endsection

@push('scripts')
<link href="{{ asset('vendor/select2/css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ asset('vendor/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('vendor/select2/js/i18n/zh-CN.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var Helper = {};
    // helper function for updaing tag name via ajax
    Helper.add_tags = function add_tags(tags) {
        var tags = $.extend({}, tags);
        $.post("{{ url('tag/save') }}", {'tags': tags})
            .done(function (msg) {
                if (msg.successed) {
                    alert(msg.message);
                }
            })
            .fail(function (err) {
                alert('err:' + JSON.stringify(err.responseText));
            });
    }

  $('#add_tags').select2({
      language: "zh-CN",
      placeholder: "逗号或空格分隔，可添加多个",
      tags: true,
      tokenSeparators: [',', ' ', '，'],
      maximumSelectionLength: 8,
  });

  $('.btn-add').on('click', function () {
      var tags = $('select').val();
      Helper.add_tags(tags);
  })

</script>
@endpush