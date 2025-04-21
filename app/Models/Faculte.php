<?php

namespace App\Models;

use App\Models\Group;
use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Faculte extends Model
{
    use HasFactory;

    public $table = 'facultes';

    public $fillable = ['name'];
    
    public $timestamps = false;

    public function getDepartment(){
        return $this->hasMany(Department::class, 'faculte_id', 'id');
    }

    // ko'pga bir bog'lanish group jadval bilan
    public function getGroup(){
        return $this->hasMany(Group::class, 'faculte_id', 'id');
    }
}
