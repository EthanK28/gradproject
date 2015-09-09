@extends('master')

@section('content')
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
            </tr>
        </thead>
        <tbody>
            @foreach($send_memos as $i => $memo)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $memo->text }}</td>
                    <td>{{ $memo->me_recv_mb_id }}</td>
                    <td></td>
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
                <td>{{ $memo->me_recv_mb_id }}</td>
                <td></td>
            </tr>
        @endforeach

        </tbody>
    </table>


@stop

@section('js')
@stop