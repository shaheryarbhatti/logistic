<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $attributes = [
        'breakoroff' => 0,
    ];

    public function teacher(){
        return $this->belongsTo(Teacher::class,'teacher_id');
    }
}
