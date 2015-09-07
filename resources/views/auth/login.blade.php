@extends('master')
<!-- resources/views/auth/register.blade.php -->

@section('content')
<form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
    {!! csrf_field() !!}



    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>


    <div>
        <button type="submit">Register</button>
    </div>
</form>
@endsection
