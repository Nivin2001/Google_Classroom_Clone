<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JoinClassroomController extends Controller
{
    //
    public function create($id)
    {
        $classroom=Classroom::active()->findOrFail($id);
        try{
            $this->exsits($id,Auth::id());

        }catch(Exception $e){
            return redirect('classrooms.show',$id);
        };


        $exsists=DB::table('classroom_user')
        ->where ('classroom_id',$id)
        ->where('user_id',Auth::id())
        ->exists();
        if($exsists)
        {
            return view('Classrooms.show',$id);
        }
        return view('Classrooms.join',compact('classroom'));

    }

    public function store(Request $request,$id)
    {
        $request->validate([
            'role'=>'in.student,teacher',

        ]);

        $classroom=Classroom::withoutGlobalScope(UserClassroomScope::class)
        ->active()
        ->findOrFail($id);
        try{
            $this->exsits($id,Auth::id());

        }catch(Exception $e){
            return redirect('classrooms.show',$id);
        };

        $classroom=Classroom::active()->findOrFail($id);
        DB::table('classroom_user')->insert([
            'classroom_id'=>$classroom->id,
            'user_id' =>Auth::id(),
        ]);
    }
    public function exsits($classroom_id,$user_id)
    {
       $exsists= DB::table('classroom_user')
        ->where ('classroom_id',$classroom_id)
        ->where('user_id',$user_id)
        ->exists();
        if($exsists)
        {
            throw new Exception(('user already exsists'));
        }


    }

}
