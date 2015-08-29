@extends('master')

@section('content')
    <!-- Main component for a primary marketing message or call to action -->
    <div class="jumbotron">
        <h1 class="text-center ">영어 단어 배우기</h1>
        <p class="text-center">
            {{ $name }} 님 환영합니다
        </p>

        <br/>
        <p>
            <a href="#" class="btn btn-lg btn-primary center-block" role="button">나의 랭킹 보러가기 &raquo;</a>
        </p>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="page-header">
                <h1>최신 플레이 기록 </h1>
            </div>
        </div>

        <div class="col-md-6">
            <div class="page-header">
                <h1>신규 등록 단어 </h1>
            </div>
        </div>
    </div>



@endsection