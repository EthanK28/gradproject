@extends('master')

@section('content')
    <div id="register" class="col-md-offset-4 col-md-4">
        <legend>
            <h1>Edit User Info</h1>
        </legend>

        @include('user.form')

    </div>

    @include('errors.list')
@endsection


