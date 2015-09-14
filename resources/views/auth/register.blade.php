@extends('master')

@section('content')
<div id="register" class="col-md-offset-4 col-md-4">
    <legend>
        <h1>Registration</h1>
    </legend>


    <form method="post" action="#">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="email_input">이메일</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" required="required" placeholder="아이디 입력">
        </div>
        <div class="form-group">
            <label for="name_input">이름 입력</label>
            <input type="text" class="form-control" name="name" id="name_input" required="required" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="password">비밀번호</label>
            <input type="password" class="form-control" name="password" id="password" required="required" placeholder="Password">
        </div>

        <div class="form-group">
            <label for="file">프로필 사진</label>
            <input type="file"  name="image" id="file">
        </div>

        <button type="submit" class="btn btn btn-danger">Register</button>
    </form>
</div>


@include('errors.list')
@endsection
