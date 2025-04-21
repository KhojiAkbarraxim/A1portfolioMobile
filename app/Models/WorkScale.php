<?php

namespace App\Models;

use app\Models\Work_type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkScale extends Model
{
    use HasFactory;
    public $table = 'work_scale';
    public $fillable = ['name'];
    public $timestamps = false;
    public function getType(){
        $this->hasMany(Work_type::class, 'scale_id', 'id');
    }
}
