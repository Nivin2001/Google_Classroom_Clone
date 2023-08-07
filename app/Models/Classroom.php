<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Classroom extends Model
{
    use HasFactory;
    public static  string $disk='public';
    // لو فجاة قررت اغير الديسك م بحتاج اغير بكل سطر مستخدماه

    protected $fillable=[
        'name','section','subject','room','theme','cover_image_path','code'
    ];
    // protected $guraded=['id','created_at','upadted_at'];
    // //هاي الاشياء الممنوع استخدامها وهي غير امنة

    public function classworks(): HasMany
    {
        // ('model_name','forigen','primary')
        return $this->hasMany(Classwork::class,'classroom_id','id');
    }

    public function topics()
    {
        // ('model_name','forigen','primary')
        return $this->hasMany(Topic::class,'topic_id','id');
    }
    
    public function users()
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



    public function tacher()
    {
        return $this->users()->wherePivot('role','=','student');
    }
    public static function UploadCoverImage($file)
    {


        $path=$file->store('/covers',[
            'disk' => static::$disk
          ]);
          return $path;
        }

        public static function DeleteCoverImage($path)
        {
            Storage::disk(Classroom::$disk)->delete($path);

        }

    public function getRouteKeyname()
    {
        // بترجعلي اسم الحقل الي بدي استخدمه
        // ك route name

        //  وبستخدمها مع rousorce root
        return 'code';
        //  بمعنى الكي راح يجيني من الكود مش من id
    }
    public function getNameAttributes($value)
    {
        return strtoupper($value);

    }
    public function getCoverImagePathAttributes($value)
    {
       if($this->cover_image_path){
        return;

       }

       return 'https://placehold.co/600x400';


    }

}

