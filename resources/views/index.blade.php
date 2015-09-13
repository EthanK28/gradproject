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
                        @foreach($rct_histories as $history)
                            <li>{!! link_to_route('scores.show', $history->score, $history->id) !!} / {!!
                                $history->created_at !!}
                            </li>
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
        <div class="col-md-6">
            <img data-src="holder.js/50x50" class="img-circle">
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
        $(function () {
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


            $("#project").autocomplete({
                minLength: 0,
                source: projects,
                focus: function (event, ui) {
                    console.log(users + 'dd');
                    console.log(projects);
                    $("#project").val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#project").val(ui.item.label);
                    $("#project-id").val(ui.item.value);
                    $("#project-description").html(ui.item.desc);
                    $("#project-icon").attr("src", "images/" + ui.item.icon);

                    return false;
                }
            })
                    .autocomplete("instance")._renderItem = function (ul, item) {
                return $("<li>")
                        .append("<a>" + item.label + "<br>" + item.desc + "</a>")
                        .appendTo(ul);
            };
        });
    </script>
    <script>
        // 그래프
        $(function () {
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
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct']
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
                series: [{
                    name: 'Tokyo',
                    data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3]
                }, {
                    name: 'London',
                    data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3]
                }]
            });
        });
    </script>
@endsection