<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    public $table = 'student';
    public $fillable = [
        'name',
        'group_id',
        'phone',
        'user_id',
        'status',
        'attach_status',
        'login',
        'parol'
    ];

    public function getGroup(){
        return $this->hasOne(Group::class, 'id', 'group_id');
    }
}
