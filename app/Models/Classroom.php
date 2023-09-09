<?php

namespace App\Models;

use Exception;
use App\Models\User;
use App\Models\Topic;

use App\Models\Classwork;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Observers\ClassroomObserver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Models\Scopes\UserClassroomScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory,SoftDeletes;

    public static  string $disk='public';
    // لو فجاة قررت اغير الديسك م بحتاج اغير بكل سطر مستخدماه

    protected $fillable=[
        'name','section','subject','room','theme','cover_image_path','code','user_id',
    ];

    // protected $guraded=['id','created_at','upadted_at'];
    // //هاي الاشياء الممنوع استخدامها وهي غير امنة

    protected $appends=[
        'cover_image_path'
    ];

    protected $hidden=[
        'password',
        'deletedat',
    ];
    protected static function booted()
    {
        // global scope for soft delete
        // static::addGlobalScope('user',function(Builder $query){
        //     $query->where('user_id','=',Auth::id());

        // });
        parent::boot();
        // ربط الobsrver
        // الي بجتوي ع الاحداث مع المودل
        static::observe(ClassroomObserver::class);

        static::addGlobalScope(new UserClassroomScope);

    }
    public function classworks(): HasMany
    {
        // classroom has many classworks
        // ('model_name','forigen key' بمعنى تابع لاس كلاس روم,'primary')
        return $this->hasMany(Classwork::class,'classroom_id','id');
    }

    public function topics():HasMany
    {
        // ('model_name','forigen','primary')
        return $this->hasMany(Topic::class,'classroom_id','id');
    }

    public function users()
    {
        //many to mnay realtionship
        //between classroom and user
        return $this->belongsToMany(
            User::class,//realted model
            'classroom_user',// pivot table
            'classroom_id',// fk for cureent model in the pivot table
            'user_id',//fk for  realted model in the pivot table
            'id',//pk for realted model
            'id',//pk for realted model
        )->withPivot(['role' , 'create_at'])
        ->as('join') ;

        }



    public function teacher()
    {
        //many to many realtion
        return $this->users()->wherePivot('role','=','teacher');
    }

    public function student()
    {
        //many to many realtion
        return $this->users()->wherePivot('role','=','student');
    }


    public function user()
    {
        return $this->belongsTo(User::class);
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
            if(!$path && ! Storage::disk(Classroom::$disk)->exists($path))
            {
                return  Storage::disk(Classroom::$disk)->delete($path); ;
            }


        }
        //local scope
        // foe soft deleting
        public function scopeActive(Builder $query)
        {
            //وظيفة scope
            // اني اعمل تعديل ع الابجكت
            // بدي يرجعلي الكلاس روم الي قيمته active

            $query->where('status','=','active');

        }

        public function scopeRecent(Builder $query)
        {
            // بتمم ترتيب الكلاس روم بشكل تنازلي
            $query->orderBy('updated_at','DESC');

        }


        public function scopeStatus(Builder $query, $status='active')
        {
            $query->where('status','=',$status);

        }

        public function join($user_id, $status = 'active', $role = 'student')
{
    //joining with realtionship

        //realtion

        $exists=$this->users()->where('id','=','user_id')->exists();
    if($exists){
        throw new Exception('user already joined the classroom');

}

// attach('user_id', [...]): The attach method is used to attach a user to the classroom,
// creating a record in the pivot table that represents this relationship.
    $this->users()->attatch('user_id',[
        'role'=>$role,
        'create_at'=>now(),
    ]);// insert in pivot table

    // DB::table('classroom_user')->insert([
    //     'classroom_id' => $this->id,
    //     'user_id' => $user_id,
    //     'role' => $role,
    //      //بمعنى اذا كان عندي role .
    //     //         // هات قيمته
    //     //         //  اذا لا حطلي القيمة هي قيمة student
    //     'create_at' => now()
    // ]);
}

        //Accessors
        // get{attributename} Attribute
        public function getNameAttribute($value)
        {
            return strtoupper($value);

        }

        public function getCoverImagePathAttribute($value)
        {
            if (array_key_exists('cover_image_path', $this->attributes)) {
                if ($this->attributes['cover_image_path']) {
                    return asset("storage/{$this->attributes['cover_image_path']}");
                } else {
                    return 'https://placehold.co/600x400';
                }
            } else {
                return 'https://placehold.co/600x400'; // Fallback if the attribute is not present
            }
        }

        public function getUrlAttribute()
        {
            //accessors instaed of using full route
            return route('classrooms.show',$this->id);
        }



    public function getRouteKeyname()
    {
        // بترجعلي اسم الحقل الي بدي استخدمه
        // ك route name

        //  وبستخدمها مع rousorce root
        return 'code';
        //  بمعنى الكي راح يجيني من الكود مش من id
    }



    //events
    //creating create

    //before make  creating theres a triger name create

    //updating ,update

    //before making real update theres a trigger update

    // saving save
    // بتشمل updating,creting

    //Deleting Deleted ,Restoring Restored,ForceDeleting Force Delete
    //Reteriveing Reterived
    //we use it when Iwant to make select

}

