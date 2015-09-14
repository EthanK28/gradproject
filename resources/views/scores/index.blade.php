@extends('master')

@section('content')
    @include('partial.flash.flash')
    {!! link_to_route('scores.create', '점수 생성') !!}
    <hr>
    <h1>점수 확인</h1>
    @if($scores)

        <table class="table">
            <tr>
                <th>No.</th>
                <th>맵 이름</th>
                <th>점수</th>
                <th>플레이 날짜</th>
                <th></th>
            </tr>
            @foreach($scores as $i => $score)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $score->map_name }}</td>
                    <td>{{ $score->score }}</td>
                    <td>{{ $score->created_at }}</td>
                    <td>
                    {!! Form::open(['route' => ['scores.destroy', $score->id], 'method' => 'delete']) !!}
                    {!! Form::submit('삭제', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        점수 없음
    @endif


@stop


