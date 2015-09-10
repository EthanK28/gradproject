<?php

namespace App\Http\Controllers;

use App\Memo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


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
        $recv_memos = Memo::where('me_recv_mb_id', 1)->get();

        $send_memos = Memo::where('me_send_mb_id', 1);

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
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
        $memo = $request->all();
        $memo['me_send_mb_id'] = 1;
        Memo::create($memo);
//        $memo->save()
        flash('쪽지 생성 완료');
        return redirect('/memos');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
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
        //
    }
}
