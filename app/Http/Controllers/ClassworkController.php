<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Classroom $classroom)
    {
        //
        $classworks=Classwork::where('classroom_id','=',$classroom->id)
        ->get();
        $classworks=$classroom->classworks;//return all classrooms

        $assigments=$classroom->classworks()//return all classworks
        ->where('type','=',Classwork::Type_ASSIGNEMNT)
        ->get();

        return view ('classrooms.index',[
            'classroom'=>$classroom,
            'classworks'=>$classworks,
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Classroom $classroom,Request $request)
    {
        //
        $type=$request->query('type');
        $allowed_types=[
            Classwork::Type_ASSIGNEMNT,classwork::TYPE_MATERIAL,classwork::Type_QUESTION
        ];
        if(!in_array($type,$allowed_types)){
            $type=Classwork::Type_ASSIGNEMNT;
        }

        return view('classworks.create',compact('classrooms'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Classroom $classroom)
    {
        //
        $type=$this->gettype($request);
        $request->validate([
            'title'=>['required','string','max:255'],
            'description'=>['nullable','string'],
            'topic_id'=>['nullable','int','exsits::topics,id'],
        ]);
        $request->merge([
            'user_id'=>Auth::id(),
            // 'classroom_id'=> $classroom->id(),

        ]);
        DB::transaction(function () use($classroom ,$request) {
            $classwork=$classroom->classworks()->craete($request->all);

            $classwork->users()->attach($request->input('students'));

        });
       $classworks=$classroom->classworks()->create($request->all());
       return redirect()
       ->route('classrooms.classworks.index',$classroom->id)
       ->with('success','classwork created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom,Classwork $classwork)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classwork $classwork)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classwork $classwork)
    {
        //
        $classwork->update($request->all());
        $classwork->users()->sync($request->input('students'));

        return back()
        ->with('success','classwork updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classwork $classwork)
    {
        //
    }
}
