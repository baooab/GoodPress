@extends('layouts.app')

@section('title', '标签管理')

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
        <div class="table-responsive">
            <table class="table">
                <caption class="text-center">标签列表</caption>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th style="width: 20%;">标签名</th>
                      <th>操作</th>
                      <th>更新时间</th></tr>
                  </thead>
                  <tbody>
                      @forelse($tags as $index => $tag)
                          <tr>
                              <th scope="row">{{ $index + 1 }}</th>
                              <td><input type="text" value="{{ $tag->name }}" maxlength="25" disabled></td>
                              <td>
                                  <button class="btn btn-defualt btn-sm btn-edit">修改</button>
                                  <button class="btn btn-primary btn-sm btn-update"
                                  data-tag="{{ $tag->id }}" style="display: none;">更新</button>
                                  @if($tag->deleted_at)
                                      <button class="btn btn-info btn-sm btn-restore" data-id="{{ $tag->id }}">还原</button>
                                      <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $tag->id }}"
                                      style="display: none;">删除</button>
                                  @else
                                      <button class="btn btn-info btn-sm btn-restore" data-id="{{ $tag->id }}"
                                      style="display: none;">还原</button>
                                      <button class="btn btn-danger btn-sm btn-delete" data-id="{{ $tag->id }}">删除</button>
                                  @endif
                              </td>
                              <td>{{ $tag->updated_at }}</td>
                          </tr>
                      @empty
                          <p>No Tags</p>
                      @endforelse
                  </tbody>
            </table>
<!--             <table class="table">
                <caption class="text-center">“文学”标签下的数据（最新10条，共22条）</caption>
                  <thead>
                    <tr>
                      <th>#</th>
                      <th style="width: 20%;">标题</th>
                      <th>类型</th>
                      <th>作者</th>
                      <th>更新时间</th>
                      <th>操作</th></tr>
                  </thead>
                  <tbody>
                      @forelse($tags as $index => $tag)
                          <tr>
                              <th scope="row">{{ $index + 1 }}</th>
                              <td>文学回忆录</td>
                              <td>博客</td>
                              <td>木心</td>
                              <td>2017-02-27 15:54:35</td>
                              <td><button class="btn btn-defualt btn-sm btn-view">详情</button></td>
                          </tr>
                      @empty
                          <p>No Posts</p>
                      @endforelse
                  </tbody>
            </table> -->
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-1">
                {{ $tags->links() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var Helper = {};
    // helper function for updaing tag name via ajax
    Helper.update_tag = function update_tag(tag) {
        var tag = $.extend({}, tag);
        $.post("{{ url('tag/update') }}", tag)
            .done(function (msg) {
                if (msg.successed) {
                    alert(msg.message);
                }
            })
            .fail(function (err) {
                alert('err:' + JSON.stringify(err.responseText));
            });
    }
    Helper.delete_tag = function delete_tag(tagid, callback) {
        $.post("{{ url('tag/delete') }}", {id: tagid})
            .done(function (msg) {
                if (msg.successed) {
                    callback();
                }
            })
            .fail(function (err) {
                alert('err:' + JSON.stringify(err.responseText));
            });
    }
    Helper.restore_tag = function restore_tag(tagid, callback) {
        $.post("{{ url('tag/restore') }}", {id: tagid})
            .done(function (msg) {
                if (msg.successed) {
                    callback();
                }
            })
            .fail(function (err) {
                alert('err:' + JSON.stringify(err.responseText));
            });
    }

    // edit tag name
    $('.btn-edit').on('click', function () {
        $(this).next().show();
        $(this).parent().prev().find('input').attr('disabled', false);
        $(this).hide();
    });

    // update tag name
    $('.btn-update').on('click', function () {
        $(this).prev().show();
        $(this).parent().prev().find('input').attr('disabled', true);
        $(this).hide();

        var tag = {
            id: $(this).attr('data-tag'),
            name: $(this).parent().prev().find('input').val()
        };
        Helper.update_tag(tag);
    });

    $('.btn-delete').on('click', function () {
        var $that = $(this);
        var tagid = $that.attr('data-id');
        Helper.delete_tag(tagid, function () {
            $that.hide().prev().show();
        });
    });

    $('.btn-restore').on('click', function () {
        var $that = $(this);
        var tagid = $that.attr('data-id');
        Helper.restore_tag(tagid, function () {
            $that.hide().next().show();
        });
    });

</script>
@endpush