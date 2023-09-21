<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassworkUser extends Pivot
{
    use HasFactory;
    protected $table = 'classwork_user';
    public $timestamps = false;


    protected $fillable=[
        'classwork_id',
        'user_id',
        'grade',
        'submitted_at',
        'status'

    ];
    public function setUpdatedAt($value)
    {
       return $this;
    }

    public function getUpdatedAtColumn()
    {
        return 'updated_at';
    }
}
