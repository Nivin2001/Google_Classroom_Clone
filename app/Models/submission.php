<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class submission extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'classwork_id',
        'type',
        'content',
    ];

    public function classwork()
    {
        // والتسليم الواحد بنتمي لكلاس ورك واحد
        return $this->belongsTo(Classwork::class);
    }
}
