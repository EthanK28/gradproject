@extends('master')
@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            단어
        </div>
        <div class="panel-body">
            <h3>단어: <strong>{{ $word->name  }}</strong></h3>
            <h4>{{ ucfirst($word->type) }}</h4>
            <hr>

            뜻: <br/>
            {{ $word->definition }}

        </div>
    </div>
@endsection
