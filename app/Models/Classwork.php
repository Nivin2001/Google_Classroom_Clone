<?php

namespace App\Models;

use App\Models\User;
use App\Models\Topic;
use App\Models\comment;
use App\Models\Classroom;
use App\Models\ClassworkUser;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classwork extends Model
{
    use HasFactory;

    //  بتعامل مع الثوابت بدل م اتعامل مع القيم الموجودة عندي
    const Type_ASSIGNEMNT='assigment';
    const TYPE_MATERIAL='material';
    const Type_QUESTION='question';

    const STATUS_PUBLISHED='published';
    const STATUS_DRAFT='draft';
    protected $fillable=[
        // column in datbase
        'classroom_id','user_id','topic_id','title','description',
        'title','status','publiahed_at','options',
    ];

    protected $cats=[
        //attribute casting
        // بتتحول لجيسون وبعدها بترجع للابجكت الاصلي
        'options'=>'json',
        'classroom_id'=>'integer',
        'published_at'=>'datetime',
    ];

    protected static function booted()
    {

        static::creating(function (classwork $classwork){
            if(!$classwork->published_at) //اذا لا يوجد بداخلها قيمة
            $classwork->published_at=now();
        });

    }

    public function scopeFilter(Builder $builder,$filters)
    {
        $builder->when($filters['search']?? '', function($bulider,$value){
            $bulider->where(function($bulider) use($value){
                $bulider->where('title','LIKE',"%{$value}")

           ->orWhere('description','LIKE',"%{$value}%");

            });
        })
        ->when($filters['type']?? '', function($bulider,$value){
                $bulider->where('type','=',"%{$value}%");

            });
    }

    public function getPublished()
    {
        //Acessors for attribute cating
        if($this->published_at){
            return $this->published_at->format('Y-M-D');
        }
    }

    public function classroom():BelongsTo
    {
        // classwork belongs to  one classroom
        return $this->belongsTo(Classroom::class,'classroom_id','id');
    }


    public function topic():BelongsTo

    {
        // topic belongs to one classwork
        return $this->belongsTo(Topic::class);
    }

    public function users()
{
    return $this->belongsToMany(User::class)
        ->withPivot(['grade', 'submitted_at', 'status', 'created_at'])
        ->using(ClassworkUser::class);
}



    public function comments()
    {
        // classwork has many comments
        return $this->morphMany(comment::class, 'commentable');
    }

    public function submissions()
    {
        //اليوزر بعمل اكتر من تسليم ع الكلاس ورك
    return $this->hasMany(submission::class);
    }



}
