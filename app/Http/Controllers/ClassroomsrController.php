<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Facaed\View;
use App\Http\Controllers\Redirect;
use Illuminate\Http\RedirectResponse;

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
        return view('Classrooms.create');

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
}

