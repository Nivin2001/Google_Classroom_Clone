<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Classwork;
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClassworkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

     protected function getType()
     {
        $type=request()->query('type');
        $allowed_types=[
            Classwork::Type_ASSIGNEMNT,classwork::TYPE_MATERIAL,classwork::Type_QUESTION
        ];
        if(!in_array($type,$allowed_types)){
            $type=Classwork::Type_ASSIGNEMNT;
        }
     }


    public function index( Request $request,$id)
    {

        $classroom=Classroom::findorfail($id);
        $classwork = Classwork::all();
        // راح اجيب كلاس ورك بناء ع
        // condition classroom
        // $classworks=Classwork::where('classroom_id','=',$classroom->id)
        // ->get();
        $classwork=$classroom->classworks()// realtion
        ->with('topic')//eager loading
        ->filter($request->query())
        ->latest('published_at','DESC')
            ->orderBy('published_at')// Query bulider
            ->paginate(2);

        // ->lazy();
        // ->paginate(2); // بتعرضلي عدد معين والافتراضي تعترض 15 بالصفحة
        // ->simplepaginate(2); // بتعرضلي عدد معين والافتراضي تعترض 15 بالصفحة

        //  افضل من ناحية الاداء م بتحجز كل ال collection
        // مرة وحدة

        return view ('Classworks.index',[
            'classroom'=>$classroom,
            'classwork'=>$classwork,

        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id, Request $request)
    {

        $classroom = Classroom::find($id);
        $response=Gate::inspect('classworks.create',[$classroom]);
        if (!$response->allowed()){
            abort(403,$response->message() ?? '');
        }
        // Gate::authorize('classworks.create',[$classroom]);


        // Get the type using the getType() method (assuming it's correctly defined)
        $type = $this->getType($request);
        $classwork=new Classwork();




        // if (Gate::denies('classworks.create',[$classroom])) {
        //     // اذا م معه هاي الصلاحية يطلعله هاد الخطا
        //     abort(403);
        // }

        return view('classworks.create', compact('classroom','classwork' ,'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,$id)
    {
        //
        $classroom = Classroom::find($id);

        $type=$this->getType($request);
        // $request->validate([
        //     //validation in classworks
        //     'title' => ['required', 'string', 'max:255'],
        //     'description' => ['nullable', 'string'],
        //     'topic_id' => ['nullable', 'integer', 'exists:topics'],
        // ]);

        $request->merge([
            'user_id'=>Auth::id(),
            // 'classroom_id'=> $classroom->id(),
            'type'=>$type,
            'create_at' => now(),

        ]);
        try{


        DB::transaction(function () use($classroom ,$request,$type) {

            $date=[
                'type'=>$type,
                'user_id'=>Auth::id(),
                'title'=>$request->input('title'),
                '	descripton'=>$request->input('	description'),
                'topic_id'=>$request->input('topic_id'),
                'published_at'=>$request->input('published_at',now()),
                'options' =>json_encode([

                        'grade' => $request->input('grade'),
                        'due' => $request->input('due'),

                ]),
                // راح يرجعلي json obj

            /*
            'due'::
            'grade:''

            */


            ];

            $classwork=$classroom->classworks()->create($date);
            // بضيف البيانات مرة وحدة بينعمل الها checked

    //    $classwork->users->attach($request->input('student'));

       $classwork->users()->attach($request->input('users'));

        });
    }catch(QueryException $e){
        return back()->with('error',$e->getMessage());
    }
       return redirect()
       ->route('classrooms.classworks.index',$classroom->id)
       ->with('success','classwork created!');
    }

    /**
     * Display the specified resource.


**/


 public function show($id, $classwork_id)
{
    $classroom = Classroom::findOrFail($id);

    $classwork = Classwork::with('comments.user')->findOrFail($classwork_id);

   Gate::authorize('classworks.create',[$classroom]);
        // اذا م معه هاي الصلاحية يطلعله هاد الخطا



    // Retrieve submissions for the specific classwork and the authenticated user
    $submissions = Auth::user()
    ->submissions()
        ->where('classwork_id', $classwork->id)
        ->get();

    return view('classworks.show', compact('classroom', 'classwork', 'submissions'));
}


    public function edit(Request $request, $classroomId, $classworkId)
    {
        // Find the classroom based on the $classroomId
        $classroom = Classroom::findOrFail($classroomId);

        // Find the specific classwork based on the $classworkId
        $classwork = Classwork::findOrFail($classworkId);

        // Fetch any other necessary data like $type and $assigned
        $type = $classwork->type;
        $assigned = $classwork->users()->pluck('id')->toArray();

        // Pass the retrieved data to the view
        return view('classworks.edit', compact('classwork', 'classroom', 'type', 'assigned'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $classroomId, $classworkId)
    {
        //
        $classroom = Classroom::findOrFail($classroomId);

        $classwork = Classwork::findOrFail($classworkId);

        $classwork->update($request->all());
        // بتتخزن البيانات في مصفوفة ولازم تكون هاي البيانات الموجودة بالجدول وتكون متطابقة
        // $classwork->users()->sync($request->input('students'));

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
