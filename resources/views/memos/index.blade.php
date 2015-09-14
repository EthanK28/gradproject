@extends('master')

@section('content')
    @include('partial.flash.flash')
    {!! link_to_route('memos.create', '쪽지 보내기', null, ['class' => 'btn btn-info']) !!}
    <hr>
    <h3 class="text-justify text-info">보낸 쪽지함</h3>
    <table class="table">

        <thead>
            <tr>
                <th>번호</th>
                <th class="memo_text">내용</th>
                <th>받는 사람</th>
                <th>보낸 날짜</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @foreach($send_memos as $i => $memo)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>
                    {!! link_to_route('memos.show', $memo->text, $memo->id) !!}
                    </td>
                    <td>{{ $memo->me_recv_mb_id }} </td>
                    <td>{{ $memo->me_send_datetime }} <a href="#" class="btn btn-danger">삭제</a></td>
                    <td>
                        {!! Form::open(['route' => ['memos.destroy', $memo->id], 'method' => 'delete']) !!}
                            {!! Form::submit('삭제', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach

        </tbody>

    </table>

    <h3 class="text-justify text-warning">받은 쪽지함</h3>
    <table class="table">
        <tr>
            <th>번호</th>
            <th class="memo_text">내용</th>
            <th>받는 사람</th>
            <th>보낸 날짜</th>
        </tr>
        <tbody>
        @foreach($recv_memos as $i => $memo)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $memo->text }}</td>
                <td>{{ $memo->me_recv_mb_id }} <a href="#" class="btn btn-danger">삭제</a></td>
                <td>
                    {!! Form::open(['route' => ['memos.destroy', $memo->id], 'method' => 'delete']) !!}
                        {!! Form::submit('삭제', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>


@stop

@section('js')
@stop