@extends('master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            단어
        </div>
        <div class="panel-body">
            단어: {{ $word->name  }}
            <hr>

            뜻: {{ $word->definition }}
        </div>
    </div>
@endsection
