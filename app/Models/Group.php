<?php

namespace App\Models;

use app\Models\Faculte;
use app\Models\Direction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Group extends Model
{
    use HasFactory;

    public $table = 'group';

    public $timestamps = false;
    public $fillable = ['name', 'faculte_id', 'direction_id'];

    // birga ko'p bog'lanish yo'nalish jadval bilan
    public function getDirection(){
        return $this->hasOne(Direction::class, 'id', 'direction_id');
    }
    //  birga ko'p bog'lanish fakultet jadval bilan
    public function getFaculte(){
        return $this->hasOne(Faculte::class, 'id', 'faculte_id');
    }
    // ko'pga bir bog'lanish
    public function getStudent(){
        return $this->hasMany(Student::class, 'group_id', 'id');
    }
}
