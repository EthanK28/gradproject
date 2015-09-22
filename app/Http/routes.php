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
Route::get('/', ['as' => 'index', function () {
    $words = DB::table('words')->orderBy('created_at', 'desc')->take(5)->get();
    $rct_histories = DB::table('scores')->orderBy('created_at', 'desc')->take(5)->get();

    // 일주일 전 로스트 체크
    // 평균 점수, 최고 점수, 플레이 횟수

    return view('index', compact('rct_histories', 'words'))->with(['name' => '강은석']);
}]);

Route::get('mainbarchart', function () {
    $data['categories'] = categories();
    $data['maxplay'] = lastWeekHighestScore('scores', 'score');
    $data['avgplay'] = lastWeekAvgData('scores', 'score');
    $data['countsofplay'] = countsOfPlay('scores', 'score');

    return json_encode($data);
});


Route::get('avgplay', function () {

    $data = lastWeekAvgData('scores', 'score');

    return json_encode($data);
});

Route::get('maxplay', function () {

    $data = lastWeekHighestScore('scores', 'score');

    return json_encode($data);
});

function barLineChartData($table_name, $name, $data)
{

    $one_week_before_now = midnightOneWeekBeforeNow();

    for ($i = 0; $i < 7; $i++) {
        $words_count['categories'][$i] = $one_week_before_now->toDateString();
        $words_count['series']['data'][] = \App\Word::where('created_at', '>', $one_week_before_now)
            ->where('created_at', '<', $one_week_before_now->copy()->addDay())->count();
        $one_week_before_now->addDay();
    }

}


// 평균 점수 구하는곳
function lastWeekAvgData($table_name, $matched_column, $value = null)
{
    $one_week_before_now = midnightOneWeekBeforeNow();

    $data['name'] = '평균 점수';
    for ($i = 0; $i < 7; $i++) {
        $score = DB::table($table_name)
            ->where('created_at', '>', $one_week_before_now)
            ->where('created_at', '<', $one_week_before_now->copy()->addDay())
            ->avg($matched_column);

        if($score == null)
            $data['data'][] = 0;
        else
            $data['data'][] = round($score, 2);

        $one_week_before_now->addDay();
    }

    return $data;
}

// 각일 최고 점수 구하는곳
function lastWeekHighestScore($table_name, $matched_column)
{
    $one_week_before_now = midnightOneWeekBeforeNow();

    $data['name'] = '최고 점수';
    for ($i = 0; $i < 7; $i++) {
        $score = DB::table($table_name)
            ->where('created_at', '>', $one_week_before_now)
            ->where('created_at', '<', $one_week_before_now->copy()->addDay())
            ->max($matched_column);

        if($score == null)
            $data['data'][] = 0;
        else
            $data['data'][] = $score;
        $one_week_before_now->addDay();
    }

    return $data;
}

function countsOfPlay($table_name, $matched_column)
{
    $one_week_before_now = midnightOneWeekBeforeNow();

    $data['name'] = '평균 플레이 횟수';
    for ($i = 0; $i < 7; $i++) {
        $data['data'][] = DB::table($table_name)
            ->where('created_at', '>', $one_week_before_now)
            ->where('created_at', '<', $one_week_before_now->copy()->addDay())->count();
        $one_week_before_now->addDay();
    }

    return $data;
}

function categories()
{

    $one_week_before_now = midnightOneWeekBeforeNow();

    $categories = [];
    for ($i = 0; $i < 7; $i++) {
        $categories[] = $one_week_before_now->toDateString();
        $one_week_before_now->addDay();
    }

    return $categories;
}

// 카테 고리
Route::get('categories', function () {

    return categories();

});

function midnightOneWeekBeforeNow()
{
    $now = \Carbon\Carbon::now();

    $now_year = $now->year;
    $now_month = $now->month;
    $now_day = $now->day;

    $today_midnight = \Carbon\Carbon::create($now_year, $now_month, $now_day, 0);

    $tmrw_midnight = $today_midnight->copy()->addDay();

    $one_week_before_now = $tmrw_midnight->copy()->subWeek();

    return $one_week_before_now;
}


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
Route::get('lastweek', function () {
    $scores = \App\Score::all();
    foreach ($scores as $i => $score) {
        $scores['time'][$i] = $score->created_at;
    }

    return $scores->toJson();
});


// 지난 일주일간 단어
Route::get('lwwords', 'WordsController@lwWords');

// 스코어 부분 처리

Route::resource('scores', 'ScoresController', [
    'only' => [
        'store', 'index', 'create', 'show', 'destroy'
    ]
]);

// Map 컨트롤러

Route::resource('maps', 'MapsController', [
    'only' => ['store', 'index', 'create', 'show']
]);

// 쪽지 컨트롤러
Route::resource('memos', 'MemosController', [
    'only' => ['store', 'index', 'create', 'show', 'destroy']
]);

// User 컨트롤러

Route::resource('user', 'UsersController', [
    'except' => ['index', 'create']
]);

// 단어

Route::get('/words/memorized/{id}', ['as'=>'words.memorized', function($id){
//    $word = Word::findOrFail($request->id);
    $word = \App\Word::findOrFail($id);


    if($word->is_memorized == false){
        $word->is_memorized = true;
    } else {
        $word->is_memorized = false;
    }

    $word->save();
    return redirect('/words');
}]);

Route::resource('words', 'WordsController');

// 플레이 히스토리 컨트롤러
Route::resource('history', 'PlayHistoryController', [
    'only' => ['index']
]);

Route::get('/userlist', function () {
    if (Request::ajax()) {
        $users = \App\User::all()->toJson();
        return $users;
    }

    $users = \App\User::find(1)->toJson();

//    dd($users);
    return $users;
});

Route::get('/score', function() {
    return "스코어";
});