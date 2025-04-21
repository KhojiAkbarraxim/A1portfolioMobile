<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Professor extends Model
{
    use HasFactory;
    public $table = 'professor';
    public $fillable = [
        'name',
        // 'login',
        // 'parol',
        'status',
        'department_id',
        'user_id'
    ];

    public function getDepartment(){
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
    public function getUser(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
