<?php

namespace App\Http\Controllers;

use App\Word;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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
        $words = \App\Word::all();
        $count_of_types = $this->countsOfTypes();
        dd($this->countsOfTypesToJson());

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
        foreach($types as $type) {

            $counts_types[$type] = Word::where('type', $type)->count();
        }

        return $counts_types;

    }

    public function countsOfTypesToJson()
    {
        $types = ['verb', 'noun', 'adjective', 'adverb', 'pronoun', 'preposition', 'conjunction', 'interjection'];
        foreach($types as $i => $type) {

            $counts_types[$i]['name'] = Word::where('type', $type)->count();
            $counts_types[$i]['y'] = Word::where('type', $type)->count();

        }



        return json_encode($counts_types);

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
        \App\Word::create($request->all());
        return redirect('/words/create');
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
    }
}
