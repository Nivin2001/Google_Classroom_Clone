<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','subject','section','roome','theme','cover_image_path','code'
    ];
    public function getRouteKeyname()
    {
        return 'code';
        //  بمعنى الكي راح يجيني من الكود مش من id
    }
}
