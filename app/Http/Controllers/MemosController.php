<?php

namespace App\Http\Controllers;

use App\Memo;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;


class MemosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // 쪽지 리스트
        $recv_memos = Memo::where('me_recv_mb_id', Auth::user()->id)->get();

        $send_memos = Memo::where('me_send_mb_id', Auth::user()->id)->get();
        foreach($send_memos as $i => $memo) {

        }

        return view('memos.index', compact('recv_memos', 'send_memos'));
//        return "메모 인덱스";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //

        return view('memos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $memo = $request->all();
//        dd($request->me_recv_mb_id);

        $memo['me_recv_mb_id'] = User::where('email', $request->me_recv_mb_id)->value('id');
        $memo['me_send_mb_id'] = Auth::user()->id;
        $memo = Memo::create($memo);
        $memo['me_send_datetime'] = Carbon::now();
        $memo->save();

        Flash::info('쪽지 보내기 성공');

        return redirect('/memos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
        $memo = Memo::findOrFail($id);

        return view('memos.show')->with('memo', $memo);

    }

    public function recvMemoShow($id)
    {

    }

    public function sendMemoShow($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {


    }
}

