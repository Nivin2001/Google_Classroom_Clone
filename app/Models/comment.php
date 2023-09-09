<?php

namespace App\Models;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class comment extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','commentable_type','commentable_id','content',
        'ip','user_agant',
    ];
    protected $with=[
        'user'
    ];

    public function user()
    {
        // العلاقة العكسية بين التعليق واليوزر .. انه هاد التعليق تابع ليوزر واحد فقط
        return $this->belongsTo(User::class)->withDefault('Deleted user');
    }


    public function commentable()
    {
        return $this->morphTo();
    }


}
