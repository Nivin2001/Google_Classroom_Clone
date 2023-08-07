<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class classroomPeopleController extends Controller
{
    //index
public function __invoke(Classroom $classroom) //  بستخدم الابجكت ك ميثود
{


        return view('Classrooms.people',compact(['classrooms']));
    }
}
