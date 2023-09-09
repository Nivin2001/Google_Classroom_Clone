<?php
namespace App\Http\Controllers;

use App\Models\Classroom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class JoinClassroomController extends Controller
{
    public function create($id)
    {
        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)->active('active')->findOrFail($id);


            try
            {
                $exists = $this->exists($classroom , Auth::id());

            }catch(Exception $e){
                return redirect()->route('classrooms.show' , $id);
           }

           return view('Classrooms.join' , compact('classroom'));
    }

    public function store(Request $request , $id)
    {

        $request->validate([
            'rule' => 'in:student,teacher'
        ]);

        $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)
        ->active('active')->findOrFail($id);
        //بدي اتاكد انو عندي كلاس روم بنفس قيمة idالموجودة في url
        try
        {
            $classroom->join( Auth::id() , $request->input('rule' , 'student'));
           

        }catch(Exception $e){
            return redirect()->route('classrooms.show' , $id);
       }



       return redirect(route('classrooms.show' , $id));
    }

    protected function exists(classroom $classroom , $user_id)
    {
        //realtion
       $exists=$classroom->users()->where('id','=','user_id')->exists();

        if($exists){
            throw new Exception('user already joined the classroom');

    }
}

}



    //
//     public function create($id)
//     {
//         $classroom=Classroom::withoutGlobalScope(UserClassroomScope::class)
//         ->active()
//         ->findOrFail($id);
//         // بدي افحص انو هاد اليوزر active
//         //علشان يقدر يعمل join
//         try{
//             $this->exsits($id,Auth::id());

//         }catch(Exception $e){
//             return redirect('classrooms.show',$id);
//         };
//         // The try block attempts to call a method called exists()
//         // with the given classroom ID and the authenticated user's ID as arguments.
//         // This method might perform some validation or checks related to the existence
//         // of the relationship between the classroom and the user.
//         // If an exception is thrown (which indicates a failure in the exists() method),
//         // the code redirects the user to the 'classrooms.show' route with the given ID.

// //   بدي افحص اذا موجود عندي الكلاس روم واليوزر

//         return view('Classrooms.join',compact('classroom'));
//         // In summary, this code is responsible for handling the logic related
//         // to checking whether a user can access a specific classroom,
//         // and whether they need to join the classroom or just view its details based
//         // on the existence of the relationship between the classroom and the user.

//     }
//     public function store(Request $request , $id)
//     {

//         $request->validate([
//             'rule' => 'in:student,teacher'
//         ]);

//         $classroom = Classroom::withoutGlobalScope(UserClassroomScope::class)->active('active')->findOrFail($id);
//         //بدي اتاكد انو عندي كلاس روم بنفس قيمة idالموجودة في url
//         try
//         {
//             $exists = $this->exists($id , Auth::id());
//             // عامل انضام لذلك بوديه ع صفحة الكلاس روم

//         }catch(Exception $e){
//             return redirect()->route('classrooms.show' , $id);
//        }

//        $classroom->join( Auth::id() , $request->input('rule' , 'student'));

//        return redirect(route('classrooms.show' , $id));
//     }


//     //  it's checking if the value of the role field is either 'student' or 'teacher'.

//     // The next block of code attempts to find an active classroom by the given ID while temporarily disabling
//     // a specific global scope (UserClassroomScope::class).
//     // The global scope might be used to filter classrooms based on the authenticated user.
//     //  If the classroom is not found, a ModelNotFoundException will be thrown.


//     // Similar to your previous code, the try block checks
//     //  if a relationship exists between the given classroom ID
//     //  and the authenticated user ID. If not, an exception
//     // is caught and the user is redirected to the 'classrooms.show' route with the given ID.

// //     The code then finds the active classroom again by ID (this step seems redundant as the classroom was already fetched earlier).

// // Finally, a new record is inserted into the 'classroom_user' pivot table to establish a relationship between the classroom and the authenticated user.
// // This is done using Laravel's query builder (DB::table).

// protected function exists($classroom_id , $user_id)
// {
//     $exists = DB::table('classroom_user')
//     ->where('classroom_id' , $classroom_id)
//     ->where('user_id' , $user_id)
//     ->exists();

//     if($exists){
//         throw new Exception('user already joined the classroom');

// }
// }

// }
