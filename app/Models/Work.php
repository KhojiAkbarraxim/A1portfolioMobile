<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Work extends Model
{
    use HasFactory;
    public $table = 'work';
    public $fillable = ['student_id', 'type_id', 'subject', 'score', 'link', 'status', 'desc', 'date'];

    public function getWorkType(){
        return $this->hasOne(Work_type::class, 'id', 'type_id');
    }
}
