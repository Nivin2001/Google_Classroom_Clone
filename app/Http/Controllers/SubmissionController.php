<?php

namespace App\Http\Controllers;
use Exception;
use Throwable;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\submission;
use App\Rules\ForbiddenFile;
use Illuminate\Http\Request;
use App\Models\ClassworkUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class SubmissionController extends Controller
{
    public function store(Request $request, $id)
    {
        $classwork = Classwork::find($id);
        // dd($classwork->id);

        // Check if the classwork with the given ID exists
        if (!$classwork) {
            abort(404);

        }

        Gate::authorize('classworks.create',[$classwork]);

        $request->validate([
            'files' => 'required|array',
            'files.*' => ['file', new ForbiddenFile('application/x-msdpwnload')],
        ]);

        // Check if the user is assigned to this classwork
        $assigned = $classwork->users()->where('id', auth()->user()->id)->exists();

        if (!$assigned) {
            abort(403);
        }

        DB::beginTransaction();
        try{

            $date=[];
            foreach ($request->file('files') as $file) {
                $date=[
                    'user_id'=> Auth::id(),
                    'classwork_id' =>$classwork->id,
                            'content' => $file->store("submissionsd/{$classwork->id}"),
                            'type' =>'file',
                            'created_at' => now(),
                            'updated_at' => now()


                ];
                submission::insert($date);

            }

        ClassworkUser::where([
            'user_id'=> Auth::id(),
            'classwork_id' =>$classwork->id,

        ])->update([
            'status' =>'submitted',
            'submitted_at' =>now(),

        ]);


        // Continue with any additional processing or redirection if needed
        DB::commit();
    }catch(Throwable $e){
        DB::rollback();
        return back()->with('error' ,$e->getMessage());


    }
    return redirect()->back()->with('success', 'Work submitted');


        }


        public function file(Request $request, $id)
        {

            $submission = submission::find($id);


            $user=Auth::user();
            // check if the user is classroom teacher

            $is_Teacher=$submission->classwork->classroom->teacher()->where('id',$user->id)->exists();
            $is_Owner=($submission->user_id==$user->id);

            if(!$is_Teacher && $is_Owner){
                abort (403);
            }
            return Storage::disk('local')->download($submission->content);
            // return response()->file(storage_path('app/' . $submission->content));


        }



        //     $submission = submission::find($id);

        //     // Check if the submission belongs to the requested classwork
        //     if ($submission->classwork_id != $id) {
        //         // Handle the case where the submission doesn't belong to the classwork
        //         abort(403);
        //     }

        //     // Fetch all submissions for the classwork
        //     $submissions = Auth::user()->submissions->where('classwork_id', $submission->classwork_id);


        //     // The rest of your code to return the file
        //     return response()->download(storage_path('app/' . $submission->content));
        // }



}
