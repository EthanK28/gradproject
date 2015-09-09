@extends('master')

@section('content')
    {!! link_to_route('memos.create', '쪽지 보내기', null, ['class' => 'btn btn-info']) !!}
    <hr>
    <h3 class="text-justify text-info">보낸 쪽지함</h3>
    <table class="table">
        <tr>
            <th>번호</th>
            <th>내용</th>
            <th>받는 사람</th>
            <th>보낸 날짜</th>

        </tr>
    </table>

    <h3 class="text-justify text-warning">받은 쪽지함</h3>
    <table class="table">
        <tr>
            <th>번호</th>
            <th>내용</th>
            <th>받는 사람</th>
            <th>보낸 날짜</th>
        </tr>
    </table>


@stop

@section('js')
@stop