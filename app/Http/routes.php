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
    $words = \App\Word::all();
    return view('index', ['name'=>'강은석', 'words'=>$words]);
}]);

// 회원 가입
Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

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
    return $users;
});