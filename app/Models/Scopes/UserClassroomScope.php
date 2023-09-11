<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBulider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserClassroomScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */

//      public function apply(Builder $builder, Model $model): void
// {
//     $id = Auth::id();

//     $builder->where('user_id', '=', $id)
//         ->orWhere(function ($query) use ($id) {
//             $query->whereRaw('classroom.id IN (SELECT classroom_id FROM classroom_user WHERE user_id = ?)', [$id]);
//         });
// }
//
//         }
public function apply(Builder $builder, Model $model): void
{

        if($id=Auth::id()){
        $builder

        // بدي الي يشوف الكلاس روم فقط ال owner
        // والشخص الي عامل انضام سواء طالب او معلم
->where(function (Builder $query) use ($id){
    $query ->where('classrooms.user_id','=',$id)
        ->orWhereExists(function (QueryBulider $query) use ($id) {
            $query->select(DB::raw(1))
            ->from('classroom_user')
            ->whereColumn('classroom_user.classroom_id','=','classrooms.id')
            ->where('classroom_user.user_id','=',$id);

        });
    });
}

    }
}

