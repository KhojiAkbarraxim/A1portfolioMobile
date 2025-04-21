<?php

namespace App\Models;

use App\Models\Student;
use App\Models\Professor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attach extends Model
{
    use HasFactory;
    public $table = 'attach';
    public $fillable = ['student_id', 'teacher_id'];

    public function getStudent(){
        return $this->hasOne(Student::class, 'id', 'student_id');
    }
    public function getProfessor(){
        return $this->hasMany(Professor::class, 'id', 'teacher_id');
    }
}
