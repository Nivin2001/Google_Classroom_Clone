<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class classroomPeopleController extends Controller
{
    //index
public function index ($id) //  بستخدم الابجكت ك ميثود
{
    $classrooms = Classroom::find($id);


        return view('Classrooms.people',compact(['classrooms']));
    }

    public function destroy(Request $request,$id)

    // detaching a user from a classroom in a many-to-many relationship.
    {
          $classroom = Classroom::find($id);
        $request->validate([
            'user_id' => ['required',/*'exists:classroom_user,user_id'*/]
        ]);
   // استخراج قيمة user_id من الطلب
        $user_id=$request->input('user_id');
            // التحقق مما إذا كان user_id لا يساوي classrooom->user_id
        if($user_id == $classroom->user_id){ // المالك

            return redirect()
            ->route('classrooms.people',$classroom->id)
            ->with('error','cant remove user');
             // لفصل السجل في الجدول الوسيط


        }
            // إزالة السجل في الجدول الوسيط
        $classroom->users()->detach('user_id');

        return redirect()->route('classrooms.people',$classroom->id)
        ->with('success','user removed');


    }
}
