@extends('master')
@section('content')
    <h1>점수 생성</h1>
    <hr>
    <form action="{{ route('scores.store') }}" method="POST">
        {!! csrf_field() !!}
        <div class="form-group">
            {!! Form::label('score', '점수')!!}
            {!! Form::text('score', null, ['class' => 'form-control', 'id' => 'score', 'required'=>'required', 'placeholder'=>'점수 입력']) !!}
        </div>


        <div class="form-group">
            {!! Form::label('map', '맵 목록') !!}
            <select name="map_id" id="map">
                @foreach($maps as $i => $map)
                    <option value="{{ $map->id }}">{{ $map->name }}</option>
                @endforeach
            </select>
        </div>


        <button type="submit" class="btn btn-primary">점수 생성</button>
    </form>
@stop
