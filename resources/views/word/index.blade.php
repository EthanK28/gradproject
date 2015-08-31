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
                <table class="table">
                    <thead>
                    <tr>
                        <th>단어</th>
                        <th>생성 날짜</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($words as $i => $word)
                        <tr>
                            <td>{!! link_to_route('words.show', $word->name, $word->id) !!}</td>
                            <td>{{ $word->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection