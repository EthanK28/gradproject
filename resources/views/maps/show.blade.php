@extends('master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            맵
        </div>
        <div class="panel-body">
            단어: {{ $map->name  }}
            <hr>
            플레이한 유저 목록
        </div>
    </div>
@endsection
