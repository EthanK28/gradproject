<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Laracasts\Flash\Flash;

class WordsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
        $words = \App\Word::paginate(5);
        $count_of_types = $this->countsOfTypes();
//        dd($this->countsOfTypesToJson());

        return view('word.index', compact('words', 'count_of_types'));
    }

    /**
     * Return the counts of all word types
     *
     * @return mixed
     */
    public function countsOfTypes()
    {
        $types = ['verb', 'noun', 'adjective', 'adverb', 'pronoun', 'preposition', 'conjunction', 'interjection'];
        foreach($types as $i => $type) {

            $counts_types[$type] = Word::where('type', $type)->count();
        }

        return $counts_types;

    }

    public function countsOfTypesToJson()
    {
        $types = ['verb', 'noun', 'adjective', 'adverb', 'pronoun', 'preposition', 'conjunction', 'interjection'];
        foreach($types as $i => $type) {

            $counts_types[$i]['name'] = $type;
            $counts_types[$i]['y'] = Word::where('type', $type)->count();

        }



        return json_encode($counts_types);

    }

    public function lwWords (){
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

        $words_count['series']['name'] = 'Test';


        for($i = 0; $i < 7; $i++)
        {
            $words_count['categories'][$i] = $one_week_before_now->toDateString();
            $words_count['series']['data'][] = \App\Word::where('created_at', '>', $one_week_before_now)
                ->where('created_at', '<', $one_week_before_now->copy()->addDay())->count();
            $one_week_before_now->addDay();
        }

        // 오늘 새벽 0시


        return json_encode($words_count);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
        return view('word.create');
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
//        dd($request);
        \App\Word::create($request->all());
        Flash::success('단어 생성 성공');
        return redirect('/words');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $word = \App\Word::find($id);

        return view('word.show', compact('word'));
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
        $word = Word::find($id);
        $word->delete();
        Flash::error('단어 삭제 성공');
        return redirect('words');
    }
}
