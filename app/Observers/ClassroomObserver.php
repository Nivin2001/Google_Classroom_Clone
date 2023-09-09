<?php

namespace App\Observers;

use App\Models\classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use  Illuminate\Support\Str;

class ClassroomObserver
{
    /**
     * Handle the classroom "created" event.
     */
    public function createing(classroom $classroom): void
    {
        //
        $classroom->code=Str::random(8);
        $classroom->user_id=Auth::id();

    }

    /**
     * Handle the classroom "updated" event.
     */
    public function updated(classroom $classroom): void
    {
        //
    }

    // /**
    //  * Handle the classroom "deleted" event.
    //  */


    public function deleted(classroom $classroom): void
    {
        if($classroom->isForceDeleting())
        {
            return;
        }


        $classroom->status='deleted';
            $classroom->save();
    }

    // public function deleting(Classroom $classroom)
    // {
    //     // Log the deleted classroom's name and status
    //     Log::info("Classroom '{$classroom->name}' (ID: {$classroom->id}) has been deleted. Status: {$classroom->status}");

    //     // You can perform other actions here if needed
    //     // However, remember that changes to attributes won't affect the database
    // }

    /**
     * Handle the classroom "restored" event.
     */
    public function restored(classroom $classroom): void
    {
        //
        $classroom->status = 'active'; // Corrected spelling
        $classroom->save();
    }

    /**
     * Handle the classroom "force deleted" event.
     */
    public function forceDelete(classroom $classroom): void
    {
        //
            // م بنفع استخدم static
        // لاني خارج المودل
        classroom::DeleteCoverImage($classroom->cover_Image_path );
    }
}
