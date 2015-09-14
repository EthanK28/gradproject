@extends('master')
@section('content')
    @include('partial.flash.flash')
    <div class="row">
        <div class="col-md-12">

            {!! link_to_route('maps.create', '맵 추가', ['class' => ['btn btn-default']] ) !!}


        </div>
    </div>
    <hr>
    <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
                맵 몹록
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th>No </th>
                        <th>맵 이름</th>
                        <th>생성 날짜</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($maps as $i => $map)
                        <tr>

                            <td>{{ $i+1 }}</td>
                            <td>{!! link_to_route('maps.show', $map->name, $map->id) !!}</td>
                            <td>{!! $map->created_at !!}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection