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
        <div class="panel panel-danger">
            <div class="panel-heading">
                <h3 class="panel-title">최신 플레이 기록 5회</h3>

            </div>
            <div class="panel-body">
                <ol>
                    @foreach($rct_histories as $history)
                        <li>{!! link_to_route('scores.show', $history->score, $history->id) !!} / {!! $history->created_at !!}</li>
                    @endforeach
                </ol>
            </div>
        </div>

    </div>

    <div class="col-md-6">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">신규 등록 단어 5개</h3>
            </div>
            <div class="panel-body">
                <ol>
                    @foreach($words as $word)
                        <li>{!! link_to_route('words.show', $word->name, $word->id) !!}</li>
                    @endforeach
                </ol>
            </div>
        </div>

    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-12">
        <h1>유저 목록
            <button id="ulbtn" class="btn btn-default">받아오기</button>
        </h1>

        <div id="userlist">

        </div>

        <input id="project">
        <input type="hidden" id="project-id">
        <p id="project-description"></p>

    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#ulbtn').click(function () {


                var index = 1;
                setInterval(function () {
                    $.ajax({
                        type: "GET",
                        url: "userlist",
                        dataType: "json",
                        success: function (data) {
                            console.log(index++ + " 번쨰");
                            var users = "<ul>";
                            $.each(data, function (i, n) {
                                users += "<li>" + i + "번째: " + n["name"] + "</li>";
                            });
                            users += "</ul>";
                            $('#userlist').append(users);

                        }
                    });
                }, 1000);

            });
        });
    </script>
    <style>
        #project-label {
            display: block;
            font-weight: bold;
            margin-bottom: 1em;
        }
        #project-icon {
            float: left;
            height: 32px;
            width: 32px;
        }
        #project-description {
            margin: 0;
            padding: 0;
        }
    </style>

    <script>
        $(function() {
            var projects = [
                {
                    value: "jquery",
                    label: "jQuery",
                    desc: "the write less, do more, JavaScript library",
                    icon: "jquery_32x32.png"
                },
                {
                    value: "jquery-ui",
                    label: "jQuery UI",
                    desc: "the official user interface library for jQuery",
                    icon: "jqueryui_32x32.png"
                },
                {
                    value: "sizzlejs",
                    label: "Sizzle JS",
                    desc: "a pure-JavaScript CSS selector engine",
                    icon: "sizzlejs_32x32.png"
                }
            ];

            var users = [];

            $.ajax({
                type: "GET",
                url: "userlist",
                dataType: "json",
                success: function (data) {

                    users = data;
                    console.log('아작스 실행');
                    console.log(data[0]);

                }
            });


            $( "#project" ).autocomplete({
                minLength: 0,
                source: projects,
                focus: function( event, ui ) {
                    console.log(users+'dd');
                    console.log(projects);
                    $( "#project" ).val( ui.item.label );
                    return false;
                },
                select: function( event, ui ) {
                    $( "#project" ).val( ui.item.label );
                    $( "#project-id" ).val( ui.item.value );
                    $( "#project-description" ).html( ui.item.desc );
                    $( "#project-icon" ).attr( "src", "images/" + ui.item.icon );

                    return false;
                }
            })
                    .autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                        .append( "<a>" + item.label + "<br>" + item.desc + "</a>" )
                        .appendTo( ul );
            };
        });
    </script>
@endsection