<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Score extends Model
{
    use HasFactory;

    public $table = 'score';
    public $fillable = ['type_id','ball'];
    public $timestamps = false;
    public function getType(){
        return $this->hasOne(Work_type::class, 'id', 'type_id');
    }
}
