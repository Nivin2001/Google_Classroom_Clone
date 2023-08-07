<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Classwork extends Model
{
    use HasFactory;
    const Type_ASSIGNEMNT='assigment';
    const TYPE_MATERIAL='material';
    const Type_QUESTION='question';
    protected $fillable=[
        // column in datbase
        'classroom_id','user_id','topic_id','title',
        'description','title','status','publiahed_at','options',
    ];
    public function classroom():BelongsTo
    {
        return $this->belongsTo(Classroom::class,'classroom_id','id');
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function users()
    {
        return $this->belongsTo(user::class)
        ->withPivot(['grade','submitted_at','status','created_at'])
        ->using(ClassworkUser::class);
       
    }
}
