<?php

namespace App\Http\Controllers;
use App\Models\Topic;
use Illuminate\Http\Request;


class TopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // for show
        $topic=Topic::orderBY('id','DESC')->get();
        return view('Topics.index',compact('topic'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
             //return form from registerations
             return view()->make('Topics.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
