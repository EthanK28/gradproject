@extends('master')
@section('content')
<div class="row">
  <div class="col-md-12">

    {!! link_to_route('words.create', '단어 추가', ['class' => ['btn btn-default']] ) !!}
    <a href="#"></a>

  </div>
</div>
<hr>
<div class="row">
  <div class="panel panel-info">
    <div class="panel-heading">
      단어 목록
    </div>
    <div class="panel-body">


     @forelse ($words as $word)
      {{ $word->name }}
    @empty
      No words
    @endforelse

    </div>
  </div>
</div>
@endsection