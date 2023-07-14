<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','section','subject','room','theme','cover_image_path','code'
    ];
    // protected $guraded=['id','created_at','upadted_at'];
    // //هاي الاشياء الممنوع استخدامها وهي غير امنة
    public function getRouteKeyname()
    {
        return 'code';
        //  بمعنى الكي راح يجيني من الكود مش من id
    }
}

