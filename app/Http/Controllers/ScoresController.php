<?php

namespace App\Http\Controllers;

use App\Map;
use App\Score;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class ScoresController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $scores = Score::where('user_id', Auth::user()->id)->get();
        foreach($scores as $i => $score)
        {

            $map_name = Map::where('id',$score->map_id)->first();
            $map_name = $map_name['name'];
            $scores[$i]['map_name'] = $map_name;


        }



        return view('scores.index', compact('scores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        $maps = \App\Map::all();
        return view('scores.create', compact('maps'));
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
        $validator = null;
        $score_tmp = $request->all();
//        dd($score_tmp);
        $score_tmp['user_id'] = "".Auth::user()->id;
//        dd($score_tmp);



        $score = \App\Score::create($score_tmp);
//        $score['user_id'] = Auth::user()->id;

        Flash::info('점수 생성 성공');

        return redirect('/scores');
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
        $score = Score::find($id);
        $score->delete();
        Flash::error('점수 삭제 성공');

        return redirect('scores');
    }
}
