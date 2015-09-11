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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($words as $i => $word)
                        <tr>
                            <td>{!! link_to_route('words.show', $word->name, $word->id) !!}</td>
                            <td>{{ $word->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h3>단어 분포</h3>
            <div id="wordspread"></div>
        </div>
        <div class="col-md-6">

        </div>
    </div>
@endsection


@section('js')
    <script>
        $(function () {

            $(document).ready(function () {

                // Build the chart
                $('#wordspread').highcharts({
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: '등록된 단어 분포'
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
                        data: [{
                            name: "Microsoft Internet Explorer",
                            y: 56.33
                        }, {
                            name: "Chrome",
                            y: 24.03
                        }, {
                            name: "Firefox",
                            y: 10.38
                        }, {
                            name: "Safari",
                            y: 4.77
                        }, {
                            name: "Opera",
                            y: 0.91
                        }, {
                            name: "Proprietary or Undetectable",
                            y: 0.2
                        }]
                    }]
                });
            });
        });
    </script>
@stop