<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;
    const CREATED_AT='created_at';
    const UPDATED_AT='updated_at';
    protected $connection='Myaql';
    protected $table='topics';
    protected $primaryKey='id';
    protected $keyType='int';
    public $incremanting=true;
    public $timestamp=false;

}
