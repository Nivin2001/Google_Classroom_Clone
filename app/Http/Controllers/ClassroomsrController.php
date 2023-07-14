<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Facaed\View;
use App\Http\Controllers\Redirect;
use Illuminate\Http\RedirectResponse;
use Illuminate\support\str;

class ClassroomsrController extends Controller
{
    //actions
    public function index(Request $request): RedirectResponse
    {
        //for show
        // in service container
        // order this object
        //return response views redirect json date file
        // echo $test->print();
        echo $request->url();
        //بيرجعلي الرابط للابجكت الحالي
        $name='nivin';
      $title='web Developer';

      return redirect(route('home'));
    //   return redirect('http://example.com');
    // return redirect()->route('route.name');
    //   return redirect()->route('classrooms.show',['1','nivin']);
    //   return redirect()->action('ControllerName@method');






        return view ('Classrooms.index',compact('name','title'));



    }
    public function create(){
        //return form frpm registerations
        return view()->make('Classrooms.create');

    }

    public function show(Request$request,$id,$edit=false){
        //show single element
        return view('Classrooms.show',[
        'id'=>$id,
        'edit'=>$edit,
        ]);

    }

    public function edit($id)
    {
        //بترجع العنصر الي بدي اعمله عليه تعديل
        return view('Classrooms.edit',[
            'id' => $id,
        ]
    );
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
        $request->merge([
            'code'=>Str::random(8),

        ]);
        $classroom=Classroom::create($request->all());

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

    }
}

