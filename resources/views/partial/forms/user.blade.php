<div class="form-group">
    {!! Form::label('이메일', '이메일') !!}
    {!! Form::text('email', null, ['class' => 'form-control', 'required' =>'required', 'placeholder' => '이메일 입력']) !!}

</div>


<div class="class">
    {!! Form::label('name', '이름') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required', => 'required', 'placeholder' => '이메일 입력']) !!}
</div>

<div class="form-group">
    {!! Form::label('password', '단어 정의') !!}
    {!! Form::password('password', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

{!! Form::submit('사용자 등록', ['class' => 'btn btn-danger']) !!}
