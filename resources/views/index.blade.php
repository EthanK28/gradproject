@extends('master')

@section('content')
        <!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
    <h1 class="text-center ">영어 단어 배우기</h1>

    <p class="text-center">
        {{ $name }} 님 환영합니다
    </p>

    <br/>

    <p>
        <a href="#" class="btn btn-lg btn-primary center-block" role="button">나의 랭킹 보러가기 &raquo;</a>
    </p>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="page-header">
            <h1>최신 플레이 기록 </h1>
        </div>
    </div>

    <div class="col-md-6">
        <div class="page-header">
            <h1>신규 등록 단어 </h1>
        </div>
        <ol>
            @foreach($words as $word)
                <li>{{ $word->name }}</li>
            @endforeach
        </ol>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <h1>유저 목록<button id="ulbtn" class="btn btn-default">받아오기</button></h1>

        <div id="userlist">

        </div>

    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#ulbtn').click(function () {


                var index = 1;
                setInterval(function(){
                    $.ajax({
                        type: "GET",
                        url: "userlist",
                        dataType: "json",
                        success: function (data) {
                            console.log(index+++" 번쨰");
                            var users = "<ul>";
                            $.each(data, function (i, n) {
                                users += "<li>"+i+"번째: " + n["name"] + "</li>";
                            });
                            users += "</ul>";
                            $('#userlist').append(users);

                        }
                    });
                }, 1000);

            });
        });
    </script>
@endsection