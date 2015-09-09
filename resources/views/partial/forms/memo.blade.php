{!! Form::open(['url' => route('memos.store'), 'method' => 'POST' ]) !!}


    <div class="form-group">
        {!! Form::label('me_recv_mb_id', '받는 사람 이메일') !!}
        {!! Form::text('me_recv_mb_id', null, ['class' => 'form-control']) !!}

    </div>

    <div class="form-group">
        {!! Form::label('text', '쪽지 내용') !!}
        {!! Form::textarea('text', null, ['class' => 'form-control']) !!}
    </div>

    {!! Form::submit('쪽지 보내기', ['class' => 'btn btn-primary']) !!}

{!! Form::close() !!}

