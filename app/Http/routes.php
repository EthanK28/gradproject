<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// 메인 화면
Route::get('/', ['as' =>  'index' ,function(){
    $words = DB::table('words')->orderBy('created_at', 'desc')->take(5)->get();
    $rct_histories = DB::table('scores')->orderBy('created_at', 'desc')->take(5)->get();

    // 일주일 전 로스트 체크
    $now = \Carbon\Carbon::now();

    return view('index', compact('rct_histories', 'words'))->with(['name' => '강은석']);
}]);


// 페이스북 연동
Route::get('login/{provider?}', 'Auth\AuthController@login');



// 회원 가입
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// 타입 카운트
Route::get('countsoftypestojson', 'WordsController@countsOfTypesToJson');

// 메인 차크 처리 일주일간 플레이 횟수
Route::get('lastweek', function() {
    $scores = \App\Score::all();
    foreach($scores as $i => $score)
    {
        $scores['time'][$i] = $score->created_at;
    }

   return $scores->toJson();
});


Route::get('lwwords', function () {
    $now = \Carbon\Carbon::now();

    $now_year = $now->year;
    $now_month = $now->month;
    $now_day = $now->day;

    $today_midnight = \Carbon\Carbon::create($now_year, $now_month, $now_day, 0);

    $tmrw_midnight = $today_midnight->copy()->addDay();

    $one_week_before_now = $tmrw_midnight->copy()->subWeek();

    // 일주일 전부터 조회한다

    $words = \App\Word::where('created_at', '<', $one_week_before_now);
    $words_count = [];
    for($i = 0; $i < 7; $i++)
    {
        $words_count[$one_week_before_now->toDateString()] = \App\Word::where('created_at', '>', $one_week_before_now)
            ->where('created_at', '<', $one_week_before_now->copy()->addDay())->count();
        $one_week_before_now->addDay();
    }

    // 오늘 새벽 0시


    return json_encode($words_count);
});

// 스코어 부분 처리

Route::resource('scores', 'ScoresController', [
   'only'=>[
        'store', 'index', 'create', 'show'
   ]
]);

// Map 컨트롤러

Route::resource('maps', 'MapsController', [
    'only' => [ 'store' ,  'index' , 'create' , 'show']
]);

// 쪽지 컨트롤러
Route::resource('memos', 'MemosController', [
    'only' => [ 'store' ,  'index' , 'create' , 'show']
]);

// User 컨트롤러

Route::resource('user', 'UsersController', [
    'except' => ['index', 'create']
]);

// 단어

Route::resource('words', 'WordsController');

// 플레이 히스토리 컨트롤러
Route::resource('history', 'PlayHistoryController', [
  'only' => ['index']
]);

Route::get('/userlist', function() {
    if (Request::ajax()) {
        $users = \App\User::all()->toJson();
        return $users;
    }

    $users = \App\User::find(1)->toJson();

//    dd($users);
    return $users;
});