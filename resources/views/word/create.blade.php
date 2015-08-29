@extends('master')
@section('content')


    <h1>데이터 베이스 단어 추가</h1>
    <hr/>
{{--     {!! Form::open()!!}
        <div class="form-group">
            {!! Form::label('name', '단어') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('email', '단어') !!}
            {!! Form::textarea('definition', null, ['class'=>'form-control']) !!}
        </div>


    {!! Form::close()!!}
 --}}
        <div>
            <form method="post" action="{{ url('words')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="email_input">단어</label>
                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" required="required" placeholder="아이디 입력">
                </div>
                <div class="form-group">
                    <label for="definition">단어 정의</label>
                    <textarea class="form-control" name="definition"  id="definition" cols="30" rows="10" required="required" placeholder="Enter name"></textarea>
                </div>

                <button type="submit" class="btn btn btn-danger">단어 등록</button>
            </form>
        </div>


@endsection