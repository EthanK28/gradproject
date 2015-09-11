@extends('master')
@section('content')


    <h1>데이터 베이스 단어 추가</h1>
    <hr/>
    {!! Form::open(['url' => route('words.store'), 'method' => 'POST' ]) !!}
        @include('partial.forms.word')
    {!! Form::close() !!}



@endsection