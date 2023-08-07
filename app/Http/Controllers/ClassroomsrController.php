<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Facaed\View;
use App\Http\Controllers\Redirect;
use App\Http\Requests\ClassroomRequest;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Illuminate\support\str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;






class ClassroomsrController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        //middleware
        // يطبق بعد انشاء الابجكت تبع الكونترلور

    }
    //actions
    public function index(Request $request)
    {
        // return the same value
        // // dd(Auth::user());
        // dd(Auth:: guard('web')->user());


      $classroom=Classroom::orderBy('created_at','DESC')-> get();

      $success=session('success');//return value of sucess in the session


      //get for return multiple row but first for return one single value
      return view ('Classrooms.index',compact('classroom','success'));
      //convert vaiable to array so we can make foreach

    }

    public function create(){
        //return form frpm registerations
        return view()->make('Classrooms.create',[
            'classroom'=>new classroom(),//empty obj to use it
        ]);


    }

    public function show(string $id) {
           //show single element
             // Classroom::where('id','=',$id)->first();
    //     // بدو يقارن قيمة id primary key
    //     //return one sindle row or more

        // Find the classroom by ID
        $classroom = Classroom::findOrFail($id);

        return view('classrooms.show')->with([
            'classroom' => $classroom
            //with() method is used to pass the $classroom variable to the view,
            // so it can be accessed within the view file.
        ]);
    }

    public function store(ClassroomRequest  $request)
    {


        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image'); // UploadedFile
            $path = Classroom::uploadCoverImage($file);
            //بينشيء ملف داخل الديسك الي أنشاءته
            $request->merge([
                'cover_image_path' => $path,
            ]);
            $validated['cover_image_path'] = $path;
        }

//
//     //             In this part, you are using the merge method of the $request object to add the random code directly to the request object.
//     //This is an alternative way to add data to the request.
//     //The merge method merges the given array into the existing request data.

//     // Both of these code blocks serve the same purpose of adding the random code to the request data.

//             ]);

        $request->merge([
            'code' => Str::random(8),
        ]);

        $validated = $request->validated();
     $classroom = Classroom::create($request->all());// store the validated date in the database


        return redirect()->route('classrooms.index')
        ->with('success', 'classroom craeted successfully');
    }



public function edit($id)
{
    //بترجع العنصر الي بدي اعمله عليه تعديل
    //بدي ارجع الكلاس روم الموجود عندي بالتالي لازم امرر ID

        // Find the classroom by ID
        $classroom = Classroom::findOrFail($id);

        return view('classrooms.edit')->with([
            'classroom' => $classroom
            //with() method is used to pass the $classroom variable to the view,
            // so it can be accessed within the view file.
        ]);
}

public function update(ClassroomRequest $request, $id)
    {
        $validated = $request->validated();
        $classroom = Classroom::findOrFail($id);
         // اذا طلبت id
//     // مش موجود بعطيني ايرور 404
//     // ممكن اعدل قيمة قيمة  او اعدلهم كلهم مرة وحدة

        if ($request->hasFile('cover_image')) {
            $file = $request->file('cover_image'); // UploadedFile
            $path = Classroom::uploadCoverImage($file);
            $validated['cover_image_path'] = $path;
        }
        $old = $classroom->cover_image_path; // بدي احتفظ بالصورة القديمة اول
        $classroom->update($validated); // وهيك بعمل تعديل ع الصورة بحتفظ بالصورة القديمة وبعدل  الصورة

        if ($old && $old != $classroom->cover_image_path) {
               // بفحص اذا موجودة وااذ القيمة القديمة لا تساوي الجديدة . اذا م عملت هيك  ممكن يحذف الصورة القديمة بدون م اعمل تغديل ع الصورة الجديدة
   // وبعدها بحذف
            Classroom::deleteCoverImage($old);
        }
        // Session::flash('success','Classroom updated successfully');
        // Session::flash('error','Test for error meesage');

        return redirect()
            ->route('classrooms.index')
            ->with('success', 'Classroom updated successfully')
            ->with('error', 'Test for error meesage');
            // ->with('type', 'success');
    }

    public function destroy($id)
    {
     Classroom::destroy($id);
 //    $count= Classroom::destroy($id);
     //بترجعلي عدد الصفوف الي تم حذفهم
     // Classroom::where('id','=',$id)->delete();

     // $classroom=Classroom::find($id);//select
     // $classroom->delete();//delete
     // echo $classroom->$id;// after deleting object
     return redirect()->route('classrooms.index')
     ->with('success', 'Classroom deleted successfully')
     ->with('error', 'classroom deleted');
    }





//    public function destroy(Classroom $classroom,$id)
//    //mpdel binding
//    {
//     $classroom = Classroom::findOrFail($id);
//     $classroom->delete();

//    $classroom::DeleteCoverImage($classroom->cover_image_path);// هيك بحذف الصورة

//     return redirect()->route('classrooms.index')
//     //flash message('name for flash message','argument')
//     ->with('success','classroom deleted')
//     ;
//    }
}
