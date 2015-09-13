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
                <table class="table">
                    <thead>
                    <tr>
                        <th>단어</th>
                        <th>생성 날짜</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($words as $i => $word)
                        <tr>
                            <td>{!! link_to_route('words.show', $word->name, $word->id) !!}</td>
                            <td>{{ $word->created_at }}</td>
                            <td>{!! link_to_route('words.destroy', '삭제', $word->id, ['class' => 'btn btn-danger']) !!}</td>
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
            <div id="wordspread"></div>
        </div>
        <div id="test" class="col-md-6">

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
                        console.log(typeof data[0].name);

                        $('#test').html(data);

                        // Build the chart
                        $('#wordspread').highcharts({
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





        });
    </script>
@stop