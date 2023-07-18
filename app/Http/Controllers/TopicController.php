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
         //collection object
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
           //method 1
        //instance from Topic model
        $topic=new Topic();
        //should be same name with column
        $topic->name=$request->post('name');
        $topic->Description=$request->post('Description');
        $topic->user_id=$request->post('user_id');
        $topic->classroom_id=$request->post('classroom_id');
        $topic->save();//insert



        //prg
        return redirect()->route('Topics.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // show single element
        //find topic by id
        $topic=Topic::Find($id);
        return view('Topics.show')-> with([
            'topics'=>$topic
        ]

        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // return the from in order to make edit
        $topic = Topic::findOrFail($id);

        return view('Topics.edit')->with([
            'topics' => $topic
            //with() method is used to pass the $topic variable to the view,
            // so it can be accessed within the view file.
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $topic=Topic::findOrFail($id);
        //2 mass assigment

        $topic->update($request->all());

          //prg
          return redirect()->route('Topics.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Topic::destroy($id);
        return redirect()->route('Topics.index');
    }
}
