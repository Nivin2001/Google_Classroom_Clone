<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Facaed\View;
use App\Http\Controllers\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect as FacadesRedirect;
use Illuminate\support\str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session as FacadesSession;






class ClassroomsrController extends Controller
{
    //actions
    public function index(Request $request)
    {
        //for show
        // in service container
        // order this object
        //return response views redirect json date file
        // echo $test->print();
        // echo $request->url();
        //بيرجعلي الرابط للابجكت الحالي
    //     $name='nivin';
    //   $title='web Developer';

    //   return view ('Classrooms.index',compact('name','title'));
      //علشان اقرا البيانات الموجودة في جدول classroom
      //collection object
      $classroom=Classroom::orderBy('created_at','DESC')-> get();
    //   session();//return session obj

    //   session()->get('success');//read session
    //  Session::get('success');

      $success=session('success');//return value of sucess in the session
    //   Session::reflash();//  بيضل محتفظ بقيمة الرسالة عند كل تحديث للصفحة



    //  Session::put ('success','whatever!');// تظهر القيمة داخل السيشن طول م انا مش حاذفها
    //  Session::flash('success','whatever!');// بتحتفظ بالقيمة next request
      // وبعدها بتم حذفها
      //store session

        // Session ::remove('success');


      //get for return multiple row but first for return one single value
      return view ('Classrooms.index',compact('classroom','success'));
      //convert vaiable to array so we can make foreach

    //   return redirect(route('home'));
    //   return redirect('http://example.com');
    // return redirect()->route('route.name');
    //   return redirect()->route('classrooms.show',['1','nivin']);
    //   return redirect()->action('ControllerName@method');
    }
    public function create(){
        //return form frpm registerations
        return view()->make('Classrooms.create');


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


    public function store(Request $request):RedirectResponse
    {
           // تخزين البيانات الي رجعت من الفورم
        // echo $request->post ('name');
        // //post  بتجيب البيانات من body  فقط
        // echo $request->query ('name');
        // echo $request['name'];
        //  بتاخد البيانات من arrayaccees

        // dd($request->all());
        // بترجعلي كل البيانات
        //    dd($request->only('name','section'));
        //    dd($request->execpt('name','section'));


        //method 1
        //instance from classroom model
        // $classroom=new Classroom();
        // //should be same name with column
        // $classroom->name=$request->post('name');
        // $classroom->section=$request->post('section');
        // $classroom->subject=$request->post('subject');
        // $classroom->room=$request->post('room');
        // $classroom->code=Str::random(8);//to 16
        // $classroom->save();//insert

        // //PRG POST REsponse

        // return redirect()->route('classrooms.index');
        // //return to home page

        //method2 massassigment
        //لازم استخدم معها دالة fillable
        //in model
        //وبحدد الحقول الي بدي تظهر عندي ولازم يكون اسمها مطابق لاسم الجدول
        // $date=$request->all();
        // $date['code']=Str::random(8);
        // $request->merge([
        //     'code'=>Str::random(8),

         if ($request->hasFile('cover_image')){// بفحص اذا دخل صورة او لا
            $file= classroom::UploadCoverImage($file); //static method
            //store in local disk
            //this path store in the database in uploads folders and genrate covers folders with
            //random img

            //join path with request
            $request->merge([//store in random name
                'cover_image_path'=>$path// same name with the field in database

            ]);

         }

        $request->merge([
            'code'=>Str::random(8),



//             In this part, you are using the merge method of the $request object to add the random code directly to the request object.
//This is an alternative way to add data to the request.
//The merge method merges the given array into the existing request data.

// Both of these code blocks serve the same purpose of adding the random code to the request data.

        ]);
        $classroom=Classroom::create($request->all());// read all date

        // $classroom=new Classroom($request->all());
        // $classroom->save();

        // $classroom=new Classroom();
        // $classroom->fill($request->all())->save;
        // //بعبي الحقول مرة وحدة
        // $classroom->forcefill($request->all())->save;
        //هاي بمعنى عبي البيانات سواء كانت موجودة بالfillable
        //او لا ولا يحبذ استخدامها

           // //PRG POST rdirect get

        return redirect()->route('classrooms.index')
        ->with('success','classroom created')
        ;
        //return to home page
// try{
//         $request->validate([
//             'name'=>'required|string|max|255',
//             'section'=>'nullable|max|255',
//             'subject'=>'string|max|255',
//             'room'=>'string|max|255',
//             'cover_image'=>[
//                 'image',
//                 Rule::dimensions([
//                     'nullable',
//                 'min_width' =>600,
//                  'min_heigh' =>300,

//                 ]),
//             ],

//         ]);

//     }catch(ValidationException $e){
//         return redirect()->back()
//         ->withInput()
//         ->withErrors([
//             'name'=>'My error'

//         ]);

//     }

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
public function update(Request $request,$id)
{
    $classroom=Classroom::findOrFail($id);
    // اذا طلبت id
    // مش موجود بعطيني ايرور 404
    // ممكن اعدل قيمة قيمة  او اعدلهم كلهم مرة وحدة

      //method 1
        //instance from classroom model
        // $classroom=new Classroom();
        // //should be same name with column
        // $classroom->name=$request->post('name');
        // $classroom->section=$request->post('section');
        // $classroom->subject=$request->post('subject');
        // $classroom->room=$request->post('room');
        // $classroom->code=Str::random(8);//to 16
        // $classroom->save();//update

        //solution 1
        // if ($request->hasFile('cover_image')){// بفحص اذا دخل صورة او لا
        //   $file=$request->file('cover_image');//uploaded file
        //   // return object contains file name

        //   $name=$classroom->cover_image_path ??str::random(40) . '.' . $file->getClientOriginalExtension();
        //   // بفحص اذا موجود قيمة بهذا الحقل قبل م اعمل تعديل ع حقل الصورة
        //   $path=$file->storeAs('/covers',basename($name),[
        //     'disk' =>  Classroom::$disk
        //   ]);

          //sol2


          $path=$classroom::UploadCoverImage($file);
          //join path with request
          $request->merge([//store in random name
              'cover_image_path'=>$path// same name with the field in database

          ]);// وهيك بعمل تعديل ع الصورة بحتفظ بالصورة القديمة وبعدل  الصورة



        $old= $classroom->cover_image_path;// بدي احتفظ بالصورة القديمة اول

             //2 mass assigment
            $classroom->update($request->all());// هيك عملت تعديل ع الصورة القديمة
            // $classroom->fill($request->all())->save();



            if($old && $old != $classroom->cover_image_path){
              // بفحص اذا موجودة وااذ القيمة القديمة لا تساوي الجديدة . اذا م عملت هيك  ممكن يحذف الصورة القديمة بدون م اعمل تغديل ع الصورة الجديدة
              // وبعدها بحذف
              $classroom::DeleteCoverImage($old);//
            }

            //prg
            // Session::put('success','classroom updated');

             return redirect()->route('classrooms.index')
             ->with('success','classroom updated')
             ;


}





   public function destroy(classroom $classroom)
   //mpdel binding
   {
    // Classroom::destroy($id);
    // حتى بعد م احذفه بتضل بيانات الابجكت  بالتالي بقدر استخدمها
//    $count= Classroom::destroy($id);
    //بترجعلي عدد الصفوف الي تم حذفهم
    // Classroom::where('id','=',$id)->delete();

    // $classroom=Classroom::find($id);//select
    // $classroom->delete();//delete
    // echo $classroom->$id;// after deleting object

   $classroom::DeleteCoverImage($classroom->cover_image_path);// هيك بحذف الصورة

    return redirect()->route('classrooms.index')
    //flash message('name for flash message','argument')
    ->with('success','classroom deleted')
    ;
   }
}
