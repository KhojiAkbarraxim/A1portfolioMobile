<?php

namespace App\Models;

use app\Models\Score;
use app\Models\WorkScale;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Work_type extends Model
{
    use HasFactory;
    public $table = 'work_type';
    public $fillable = ['scale_id','name'];

    public $timestamps = false;
    public function getScore(){
        return $this->hasOne(Score::class, 'type_id', 'id');
    }
    public function getScale(){
        return $this->hasOne(WorkScale::class, 'id', 'scale_id');
    }
}
