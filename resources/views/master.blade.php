<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    {{--<link rel="icon" href="../../favicon.ico">--}}

    <title>졸업작품 영어 게임</title>
    <!-- jQuery UI -->
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">

    <!-- Bootstrap core CSS -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom css -->
    <link href="/css/common.css" rel="stylesheet">


    <script src="{{ asset('js/holder.js') }}"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Fixed navbar -->
<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">영어 단어 게임</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active">{!! link_to_route('index', 'Home') !!}</li>
                <li>{!! link_to_route('words.index', '단어') !!}</li>
{{--                <li>{!! link_to_route('history.index', '플레이 히스토리')!!}</li>--}}
                <li>{!! link_to_route('scores.index', '점수 보기')!!}</li>
                {{--<li><a href="/freindranking">친구 랭킹 </a></li>--}}
                <li>{!! link_to_route('maps.index', '맵') !!}</li>
                <li>{!! link_to_route('memos.index', '쪽지') !!}</li>
                {{--<li><a href="/gradproject/memberlist.php">가입된 회원보기(관리자)</a></li>--}}

                <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>-->
            </ul>
            @if(Auth::check())
                <ul class="nav navbar-nav navbar-right">



                    <li>@if(Auth::user()->avartar =! "") <img src="{{ Auth::user()->avatar }}" style="width: 45px;" class="img-circle"/> @endif
                        <span class="navbar-text">Signed in as <span style="color:#23527c"><strong>{{ Auth::user()->name }}</strong></span></span></li>
                    <li>{!! link_to_action('Auth\AuthController@getLogout', '로그 아웃') !!}</li>

                </ul>

            @else
                <ul class="nav navbar-nav navbar-right">

                    <li>dd</li>
                    <li><a href="/login/facebook">Facebook<i class="fa fa-facebook-square fa-lg"></i></a></li>
                    <li>{!! link_to_action('Auth\AuthController@getRegister', '회원가입') !!}</li>
                    <li>{!! link_to_action('Auth\AuthController@getLogin', '로그인') !!}</li>

                </ul>
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">
    @yield('content')
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="{{ asset('js/jquery-1.11.2.min.js') }}"></script>

<script src="/bootstrap/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<!--<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>-->

<!-- Jquery Ui JavaScript -->
<script src="{{ asset('js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/highcharts.js') }}"></script>


@yield('footer')
@yield('js')

<script src="{{ asset('js/placeholders.js') }}"></script>
<script src="{{ asset('js/countUp.js') }}"></script>
</body>
</html>



