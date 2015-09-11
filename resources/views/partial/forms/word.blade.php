<div class="form-group">
    {!! Form::label('name', '단어') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'required' =>'required', 'placeholder' => '단어 입력']) !!}

</div>

<div class="class">
    {!! Form::label('type', '타입') !!}
    {!! Form::select('type', ['verb', 'noun' => 'noun', 'adjective'=> 'adjective', 'adverb' => 'adverb',
                'pronoun' => 'pronoun', 'preposition' => 'preposition' , 'conjunction' => 'conjunction',
    'interjection' => 'interjection'], null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('definition', '단어 정의') !!}
    {!! Form::textarea('definition', null, ['class' => 'form-control', 'cols' => '20', 'rows' => '5',
    'required' => 'required']) !!}
</div>

{!! Form::submit('단어 등록', ['class' => 'btn btn-danger']) !!}


