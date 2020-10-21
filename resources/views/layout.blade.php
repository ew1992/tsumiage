<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="ページのタイトル" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{url('/')}}" />
    <meta property="og:image" content="{{url('/')}}/img/logo.png" />
    <meta property="og:site_name" content="#今日の積み上げ" />
    <meta property="og:description" content="ページのディスクリプション" />
    <meta name="twitter:card" content="summary" />

    <title>#今日の積み上げ</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Validation-Engine/2.6.4/validationEngine.jquery.min.css" type="text/css"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/css/drawer.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body class="drawer drawer--right">
    <header class="drawer-navbar" role="banner">
        <div class="drawer-container">
            <div class="drawer-navbar-header">
                <a class="title drawer-brand" href="{{ url('/') }}">#今日の積み上げ</a>

                <button class="drawer-toggle drawer-hamburger" type="button">
                    <span class="sr-only">toggle navigation</span>
                    <span class="drawer-hamburger-icon"></span>
                </button>
            </div>
            <nav class="drawer-nav" role="navigation">
                <ul class="drawer-menu drawer-menu--right">
                    <!-- Authentication Links -->
                    @guest
                        <li>
                            <a class="drawer-menu-item" href="{{ route('login') }}">ログイン</a>
                        </li>
                        @if (Route::has('register'))
                            <li>
                                <a class="drawer-menu-item" href="{{ route('register') }}">新規登録</a>
                            </li>
                        @endif
                    @else
                        @if(url()->current() == url("/"))
                            <li><a class="drawer-menu-item" href="/calendar">一覧表示</a></li>
                            <li><a class="drawer-menu-item" href="/list">All Members</a></li>
                        @elseif(url()->current() == url("/calendar"))
                            <li><a class="drawer-menu-item" href="/">入力画面</a></li>
                            <li><a class="drawer-menu-item" href="/list">All Members</a></li>
                        @else
                            <li><a class="drawer-menu-item" href="/">入力画面</a></li>
                            <li><a class="drawer-menu-item" href="/calendar">一覧表示</a></li>
                            <li><a class="drawer-menu-item" href="/list">All Members</a></li>
                        @endif

                        <li class="drawer-dropdown">
                            <a class="drawer-menu-item" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user() -> name }} <span class="drawer-caret"></span>
                            </a>
                            <ul class="drawer-dropdown-menu dropdown-menu">
                                <li><a class="drawer-dropdown-menu-item" href="{{ route('contact.index') }}">お問い合わせ</a></li>
                                <li><a class="drawer-dropdown-menu-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    ログアウト
                                </a></li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </ul>
                        </li> 
                    @endguest
                </ul>
            </nav>
        </div>
    </header>

    <main class="content" role="main">
        @yield('content')
    </main>
    <div>
        @yield('footer')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/iScroll/5.2.0/iscroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/drawer/3.2.2/js/drawer.min.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $('.drawer').drawer();
            $('.drawer-dropdown').on('show.bs.dropdown', function(){                                                                                       
                $(this).addClass("open");                                                                                                                    
            });
            $('.drawer-dropdown').on('hide.bs.dropdown', function(){                                                                                       
                $(this).removeClass("open");                                                                                                                 
            });
        });

        window.twttr=(function(d,s,id){
            var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;
        }(document,"script","twitter-wjs"));
    </script>
</body>
</html>