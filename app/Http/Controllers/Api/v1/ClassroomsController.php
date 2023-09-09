<?php

namespace App\Http\Controllers\Api\v1;

use Throwable;
use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClassroomResource;
use Illuminate\Support\Facades\Response;

class ClassroomsController extends Controller
{
    //
    public function index()
    {
        $classrooms = Classroom::with('user:id,name', 'topics')
            ->withCount('student as students')
            ->paginate(2);

            return ClassroomResource::collection($classrooms);
        // return response()->json(
        //     $classrooms,
        //     400,
        //     [
        //         'x-test' => 'test'

        //     ]
        // );
    }


    public function show(string $id, Request $request)
{
    // Find the classroom by ID and load the user and student relationships
    $classroom = Classroom::findOrFail($id)->load('user')->loadCount('student');

    // Load the count of students
    // $classroom->loadCount('student');

    return new ClassroomResource($classroom);
}


    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => ['required'],
            ]);
        } catch (Throwable $e) {
            return Response::json(
                [
                    'message' => $e->getMessage(),
                ],
                422
            );
        }
            $classroom = Classroom::craete($request->all());
            return [
                'code' => 100,
                'message' => __('classrooms.created.'),
                'classroom' => $classroom,
            ];

    }



    public function update(string $id, Request $request)
    {
        $classroom = classroom::findorFail($id);
        try {
            $request->validate([
                'name' => ['sometimes', 'required', Rule::unique('classrooms', 'name')],
                'section' => ['nullable'],
            ]);
            $classroom = Classroom::update($request->all());
            return [
                'code' => 100,
                'message' => __('classrooms.updated.'),
                'classroom' => $classroom,
            ];
        } catch (Throwable $e) {
            return Response::json(
                [
                    'message' => $e->getMessage(),
                ],
                4222
            );
        }
    }


    public function destroy(string $id)
    {
        Classroom::destroy($id);
        return response()->json([], 204);
    }
}
