<?php

namespace App\Models;

use App\Models\Faculte;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    public $table = 'departments';

    public $fillable = [
        'faculte_id',
        'name'
    ];
    public $timestamps = false;
    public function getFaculte(){
        return $this->hasOne(Faculte::class, 'id', 'faculte_id');
    }
    public function getProfessor(){
        return $this->hasMany(Professor::class, 'department_id', 'id');
    }
}
