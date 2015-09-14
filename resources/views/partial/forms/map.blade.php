<div class="form-group">
    {!! Form::label('name', '맵 이름') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' =>'required', 'placeholder' => '맵 이름 입력']) !!}

</div>

{!! Form::submit('맵 등록', ['class' => 'btn btn-danger']) !!}
