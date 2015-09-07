<div class="form-group">
    {!! Form::label('score', '점수')!!}
    {!! Form::text('score', null, ['class' => 'form-control', 'id' => 'score', 'required'=>'required', 'placeholder'=>'점수 입력']) !!}
</div>
<div class="form-group">
    <select name="map_id" id="map">
        @foreach($maps as $i => $map)
            <option value="{{ $map->id }}">{{ $map->name }}</option>
        @endforeach
    </select>
</div>
