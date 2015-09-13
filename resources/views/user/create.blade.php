@extends('master')

@section('content')
<div id="register" class="col-md-offset-4 col-md-4">
    <legend>
        <h1>Registration</h1>
    </legend>

    {!! Form::open(['route' => 'auth.register', 'method' => 'post']) !!}
        @include('partial.forms.user')
    {!! Form::close() !!}
</div>

    @include('errors.list')
@endsection


