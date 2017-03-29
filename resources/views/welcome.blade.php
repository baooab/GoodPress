<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />

        <title>首页 | 又一个GoodPress网站</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            @font-face {
                font-family: 'Microsoft YaHei',SimHei,Verdana,Raleway,'PingFang SC';
                src: url('http://resource.wufazhuce.com/pingfang-sc-light.ttf');
            }

            html, body {
                font-family: 'PingFang SC', Raleway, Mingliu, sans-serif;
                background: url(http://image.wufazhuce.com/FuJ7LNrgBwwQvJLQSd4e1zEO3tBS) no-repeat;
                background-size: cover;
                background-position: 50% 50%;
                transition: all 2s ease-out;
                /**/
                color: #fff;
                font-weight: 100;
                height: 100vh;
                margin: 0;

                text-shadow: 0 1px 1px #333;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                /**/
                padding: 1.5em 6em;
                border-radius: .5em;
                background: rgba(0, 0, 0, .3);
            }

            .title {
                font-size: 2rem;
            }

            .links {
                /**/
                border-radius: 1.25em;
                padding: .2rem 5rem;
                background: rgba(0, 0, 0, .3);
            }
            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 1rem;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .links:hover {
                background: #fff;
            }
            .links:hover > a {
                color: #000;
            }
            .links > a:hover {
                text-decoration: underline;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">站点首页</a>
                    @else
                        <a href="{{ url('/login') }}">登录</a>
                        <a href="{{ url('/register') }}">注册</a>
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    又一个GoodPress网站
                </div>

                <div class="links">
                    <a href="{{ url('post') }}">博客</a>
                    <a href="{{ url('image') }}">图集</a>
                </div>
            </div>
        </div>
    </body>
</html>
