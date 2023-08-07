<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    const CREATED_AT='created_at';
    const UPDATED_AT='updated_at';
    protected $connection='mysql';
    protected $table='topics';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incremanting=true;
    public $timestamps=false;
    //with mass assigment method
    protected $fillable=['name','Descrption','user_id','classroom_id'];

    public function classworks()
    {
        return $this->hasMany(Classwork::class,'topic_id','id');
    }




}
