<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Attribute;
use App\Models\comment;
use App\Models\Classroom;
use App\Models\Classwork;
use App\Models\ClassworkUser;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */


    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function classromms()


        {
            return $this->belongsToMany(
                user::class,//realted model
                'classroom_user',// pivot table
                'classroom_id',// fk for cureent model in the pivot table
                'user_id',//pk for cureent model
                'id',//pk for realted model
                'id',
            )->where('role','=','teacher')
            ->withPivot(['role' , 'created_at'])
            ->as('join')
            ;

            }

            public function createdClassromms()
            {
                $this->hasMany(Classroom::class,'user"id');
            }

            //matuators
            // public function setEmailAttribute($value)
            // {
            //     $this->email=strtolower($value);
            // }

            // register new user
            protected function email()
            {
                return Attribute::make(
                    get:fn($value)=>strtoupper($value),// accessors
                    set:fn($value)=>strtolower($value)// matutors
                );

            }

            public function classrooms()
            {
                //many to mnay realtionship
        return $this->belongsToMany(
           classroom::class,//realted model
            'classroom_user',// pivot table
            'user_id',// fk for cureent model in the pivot table
            'classroom_id',//fk for realted model
            'id',//pk for realted model
            'id',//pk for realted model
        )->where('role','=','teacher')
        ->withPivot(['role' , 'created_at'])

        ;

        }

        public function created_classrooms()
        {
           return  $this->hasMany(Classroom::class,'user_id');
        }

        public function classworks()

        {
            //many to mnay realtionship between user and classworks
            return $this->belongsToMany(Classwork::class)
            ->using(ClassworkUser::class)
            ->withPivot(['grade','status','submitted_at','created_at']);
        }

        public function comments()
        {
            return $this->hasMany(comment::class);
        }

        public function submissions()
        {
            return $this->hasMany(submission::class);
        }

            }


