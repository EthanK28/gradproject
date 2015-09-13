@extends('master')
<!-- resources/views/auth/register.blade.php -->

@section('content')
    <div class="row">
        <form method="POST" action="{{ action('Auth\AuthController@postLogin') }}">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control">
            </div>

            <div class="form-group">
                Password
                <input type="password" name="password" class="form-control">
            </div>


            <div>
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
@endsection
