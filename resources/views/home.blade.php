@extends('layouts.app')

@section('title', '功能清单');

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">功能清单</div>

                <div class="panel-body">
                    <ul>
                        <li>
                            <a href="{{ url('register') }}">注册</a>、
                            <a href="{{ url('login') }}">登录</a>、
                            <a href="{{ url('password/reset') }}">发送秘密重置链接</a>、
                            <a href="{{ url('password/reset/31ef7475a336739f5a649eb9ff843679c3ecc31cd33350fd701eff0d31f8567c') }}">重置密码</a></li>
                        <li>
                            <a href="{{ url('post') }}">博客</a>
                        </li>
                        <li>
                            <a href="{{ url('tag') }}">标签</a>
                        </li>
                        <li>图集</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
