<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Classroom;
use App\Models\classwork;
use Illuminate\Auth\Access\Response;

class ClassworkPolicy
{


     public function before(User $user,$ability)
     {

        {
            // if($user->super_admin)
            return true;

        }
     }
    public function viewAny(User $user , Classroom $classroom): bool
    {

        //index
        // dd($classroom);
        return $user->classrooms()->withoutGlobalScope(UserClassroomScope::class)
        ->wherePivot('classroom_id', '=', $classroom->id)
        ->exists();

    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, classwork $classwork): bool
    {
        //show
        // dd($user->classworks);

        $teacher=$user->classrooms()
        ->withoutGlobalScope(UserClassroomScope::class)
        ->wherePivot('classroom_id', '=', $classwork->classroom_id)
        ->wherePivot('role', '=', 'teacher')
        ->exists();

        $assigned=$user->classworks()
        ->wherePivot('classwork_id', '=', $classwork->id)
        ->exists();
        return ($teacher || $assigned);


    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user,Classroom $classroom): bool
    {
        //
        $result=$user->classrooms()
        ->withoutGlobalScope(UserClassroomScope::class)
        ->wherePivot('classroom_id', '=', $classroom->id)
        ->wherePivot('role', '=', 'teacher')
        ->exists();

       return $result

       ? Response::allow()
       : Response::deny('You are not teacher in this classwork');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, classwork $classwork): bool
    {
        //
        $assigned =  $classwork->user_id == $user->id ;
       $teacher= $user->classrooms()
        ->wherePivot('classroom_id', '=', $classwork->classroom->id)
        ->wherePivot('role', '=', 'teacher')
        ->where('classroom_user.user_id', $user->id)
        ->exists();

        return ($assigned && $teacher );

        // return ($result);

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, classwork $classwork): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, classwork $classwork): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, classwork $classwork): bool
    {
        //
    }
}
