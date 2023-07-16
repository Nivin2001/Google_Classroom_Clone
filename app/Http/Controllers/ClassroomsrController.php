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
      //get for return multiple row but first for return one single value
      return view ('Classrooms.index',compact('classroom'));
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
        $classroom=new Classroom();
        //should be same name with column
        $classroom->name=$request->post('name');
        $classroom->section=$request->post('section');
        $classroom->subject=$request->post('subject');
        $classroom->room=$request->post('room');
        $classroom->code=Str::random(8);//to 16
        $classroom->save();//insert

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

        // ]);
        // $classroom=Classroom::create($request->all());

        // $classroom=new Classroom($request->all());
        // $classroom->save();

        // $classroom=new Classroom();
        // $classroom->fill($request->all())->save;
        // //بعبي الحقول مرة وحدة
        // $classroom->forcefill($request->all())->save;
        //هاي بمعنى عبي البيانات سواء كانت موجودة بالfillable
        //او لا ولا يحبذ استخدامها

           // //PRG POST REsponse

        return redirect()->route('classrooms.index');
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

        //2 mass assigment

            $classroom->update($request->all());
            // $classroom->fill($request->all())->save();

            //prg
             return redirect()->route('classrooms.index');


}
   public function destroy($id)
   {
    Classroom::destroy($id);
    //بترجعلي عدد الصفوف الي تم حذفهم
    // Classroom::where('id','=',$id)->delete();

    // $classroom=Classroom::find($id);//select
    // $classroom->delete();//delete
    // echo $classroom->$id;// after deleting object
    return redirect()->route('classrooms.index');
   }
    }

