<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Facaed\View;
use App\Http\Controllers\Redirect;
use App\Http\Requests\ClassroomRequest;
use App\Models\Topic;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Illuminate\support\str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session as FacadesSession;

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


   // Validate the incoming data
   $validatedData = $request->validate([
    'name' => 'required|string|max:255',
    'Description' => 'required|string',
]);

// Create a new Topic using mass assignment
    $topic = Topic::create($validatedData);

// Redirect to the index route with a success message
    return redirect()->route('topics.index')->with('success', 'Topic created successfully');


        // // $validated=$request->validate([
        // //     'name'=>'required',
        // //     'Description'=>'required',
        // // ]);
        //    //method 1
        // //instance from Topic model
        // $topic=new Topic();
        // //should be same name with column
        // $topic->name=$request->post('name');
        // $topic->Description=$request->post('Description');
        // $topic->save();//insert

        // return redirect()->route('topics.index')
        // ->with('success', 'Topics craeted successfully');
        // ;

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
