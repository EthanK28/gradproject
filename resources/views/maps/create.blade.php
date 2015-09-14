@extends('master')

@section('content')
    {!! Form::open(['url' => route('maps.store'), 'method' => 'POST']) !!}
    @include('partial.forms.map')
    {!! Form::close() !!}
@stop