<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stream extends Model
{
    use HasFactory, HasUuids;

    // primary key id uuid and become not incremanting
    public $incremanting=false;
    protected $keyType='string';

    protected $fillable=[
        'user_id',
        'content',
        'classroom_id',
        'link'
    ];

    public function setUpdatedAt($value)
    {
       return $this;
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
