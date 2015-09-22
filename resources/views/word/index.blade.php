@extends('master')
@section('content')
    <div class="row">
        <div class="col-md-12">

            {!! link_to_route('words.create', '단어 추가', ['class' => ['btn btn-default']] ) !!}
            <a href="#"></a>

        </div>
    </div>
    <hr>
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                단어 목록
            </div>
            <div class="panel-body">
                @include('partial.flash.flash')
                <table class="table">
                    <thead>
                    <tr>
                        <th>단어</th>
                        <th>생성 날짜</th>
                        <th>암기 여부</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($words as $i => $word)
                        <tr>
                            <td>{!! link_to_route('words.show', $word->name, $word->id) !!}</td>
                            <td>{{ $word->created_at }}</td>
                            <td>
                                @if($word->is_memorized == false)
                                    {!! link_to_route('words.memorized', '미암기', $word->id, ['class' =>'btn btn-warning'])!!}
                                @else
                                    {!! link_to_route('words.memorized', '암기', $word->id, ['class' =>'btn btn-success'])!!}
                                @endif
                            </td>
                            <td>
                                {!! Form::open(['route' => ['words.destroy', $word->id], 'method' => 'delete']) !!}
                                {!! Form::submit('삭제', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $words->render() !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>단어 분포</h3>
            <div id="wordspread">

            </div>
        </div>
        <div class="col-md-6">
            <div id="container">

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
@endsection


@section('js')
    <script>
        $(function () {

                // 차트 데이터

                var source = [];
                $.ajax({
                    type: "GET",
                    url: "/countsoftypestojson",
                    dataType: "json",
                    success: function (data) {

                        source = data;
                        console.log('아작스 실행');
                        console.log(data);
                        console.log('첫번째 아작스');


                        $('#test').html(data);

                        // Build the chart
                        $('#container').highcharts({
                            chart: {
                                plotBackgroundColor: null,
                                plotBorderWidth: null,
                                plotShadow: false,
                                type: 'pie'
                            },
                            credits: {
                                enabled: false
                            },
                            title: {
                                text: '등록된 단어 종류별 분포'
                            },
                            tooltip: {
                                pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                            },
                            plotOptions: {
                                pie: {
                                    allowPointSelect: true,
                                    cursor: 'pointer',
                                    dataLabels: {
                                        enabled: false
                                    },
                                    showInLegend: true
                                }
                            },
                            series: [{
                                name: "Brands",
                                colorByPoint: true,
                                data: data
                            }]
                        });

                    }
                }).fail(function(){
                    console.log('아작스 실패');
                });

            $.ajax({
               type: "GET",
                url: "/lwwords",
                dataType:"json",
                success: function(data) {
                    console.log(data['series'].name);
                    console.log(data['series']);
                    console.log(data['categories']);

                    $('#wordspread').highcharts({
                        chart: {
                            type: 'line'
                        },
                        title: {
                            text: '최근 일주일간 단어 추가 비율'
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
                        series: [{
                            name: data['series'].name,
                            data: data['series'].data
                        }]
                    });
                }
            });








        });
    </script>
@stop