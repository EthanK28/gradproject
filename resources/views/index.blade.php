@extends('master')

@section('content')
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1 class="text-center ">영어 단어 배우기</h1>

        @if(Auth::check())
            <p class="text-center">
                {{ Auth::user()->name }} 님 환영합니다
            </p>
        @endif
        <br/>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h3 class="panel-title">최신 플레이 기록 5회</h3>

                </div>
                <div class="panel-body">
                    <ol>
                        @if(Auth::check())
                            @foreach($rct_histories as $history)
                                <li>{!! link_to_route('scores.show', $history->score, $history->id) !!} / {!!
                                    $history->created_at !!}
                                </li>
                            @endforeach
                        @else
                            로그인 필요
                        @endif
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
                        @if(Auth::check())
                            @foreach($words as $word)
                                <li>{!! link_to_route('words.show', $word->name, $word->id) !!}</li>
                            @endforeach
                        @else
                            로그인 필요
                        @endif
                    </ol>
                </div>
            </div>

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">

        </div>
        <div class="col-md-6">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div id="container"></div>
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

    <script>
        // 그래프

        $(function () {

            var categories = $.get('/categories', function (data) {
                    console.log(data);
                    console.log("아작스: "+Date.now());


            });

            $.ajax({
                type: "GET",
                url: "mainbarchart",
                dataType: "json",
                success: function (data) {
                    console.log(data);
//                    console.log(data['maxplay']);
//                    console.log(data['avgplay']);

                    $('#container').highcharts({
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: '최근 일주일 플레이 횟수'
                        },
                        subtitle: {
                            text: ''
                        },
                        xAxis: {
                            categories: data['categories']
                        },
                        yAxis: {
                            title: {
                                text: 'Temperature (°C)'
                            }
                        },
                        plotOptions: {
                            line: {
                                dataLabels: {
                                    enabled: true
                                },
                                enableMouseTracking: false
                            }
                        },
                        series: [
                            data['avgplay'],
                            data['maxplay'],
                            data['countsofplay']

                        ]
                    });
                }
            });


            console.log(Date.now());

        });
    </script>
@endsection