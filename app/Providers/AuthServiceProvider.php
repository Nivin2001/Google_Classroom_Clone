<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\Scopes\UserClassroomScope;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        ClassroomWork::class => ClassroomWorkPolicy::class,
    ];


    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Define Gate(ablities)

        // filtering
        // اذا كان سوبر ادمن بكون معه صلاحيات كاملو
        Gate::before(function(User $user,$ability)
        {
            if($user->super_admin)
            return true;

        });

        // Gate::define('classworks.view',function (User $user ,Classwork $classwork){
        //    $teacher= $user->classrooms()
        //     ->wherrPivot('classroom_id','=',$classwork->classroom_id)
        //     ->wherePivot('role','=','teacher')
        //                 ->exists();

        //    $assigned=$user->classworks()
        //    ->wherrPivot('classwork_id','=',$classwork->id)
        //    ->exists();

        //    return ($teacher || $assigned)
        //    ? Response::allow()
        //    :  Response::deny('you are not assigned to this classwork')
        //    ;

        // });


        // Gate::define('classworks.create',function (User $user,Classroom $classroom){

        //    $result=$user->classrooms()
        //     // ->withoutGlobalScope(UserClassroomScope::class)
        //     ->wherePivot('classroom_id', '=', $classroom->id)
        //     ->wherePivot('role', '=', 'teacher')

        //     ? Response::allow()
        //     :  Response::deny('you are not a teacher  in this classroom');

        // });

        // Gate::define('classworks.update',function (User $user,Classwork $classwork){

        //     // اليوزر الحالي يكون صاحب الكلاس ورك
        //     // بالتالي راح يكون هو المعلم

        //     $user->classrooms()
        //     ->wherePivot('classroom_id', '=', $classwork->classroom->id)
        //     ->wherePivot('role', '=', 'teacher')
        //     ->where('user_id', $user->id)
        //     ->exists();


        // });

        // Gate::define('classworks.delete',function (User $user,Classwork $classwork){
        //  $user->classrooms()
        //     ->wherePivot('classroom_id', '=', $classwork->classroom->id)
        //     ->wherePivot('role', '=', 'teacher')
        //     ->where('user_id', $user->id)
        //     ->exists();




        // });

        Gate::define('submissions.create', function (User $user, Classwork $classwork) {
            // Check if the user is a teacher in the classroom
            $teacher = $user->classrooms()
                ->withoutGlobalScope(UserClassroomScope::class)
                ->wherePivot('classroom_id', '=', $classwork->classroom_id)
                ->wherePivot('role', '=', 'teacher')
                ->exists();

            // Check if the user is assigned to the classwork
            $assigned = $user->classworks()
                ->wherePivot('classwork_id', '=', $classwork->id)
                ->exists();

            // Allow access if the user is assigned and not a teacher
            return !$teacher && $assigned;
        });

}
}
