@extends('master')
@section('content')
    <h1>점수 생성</h1>
    <hr>
    <form action="#" method="POST">
        {!! csrf_field() !!}

        <div class="form-group">
            <label for="score">점수</label>
            <input type="text" class="form-control" name="score" id="scroe" required="required" placeholder="점수 입력">
        </div>
        <select name="map_id" id="map">
            @foreach($maps as $i => $map)
                <option value="{{ $map->id }}">{{ $map->name }}</option>
            @endforeach
        </select>


        <button type="submit" class="btn btn-primary">점수 생성</button>
    </form>
@stop
