<?php

namespace App\Models;

use App\Models\comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class post extends Model
{
    use HasFactory;
    public function comments()
{ 
    // classwork has many comments
    return $this->morphMany(comment::class, 'commentable');
}

}
