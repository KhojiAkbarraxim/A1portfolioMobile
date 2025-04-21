<?php

namespace App\Models;

use app\Models\Group;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Direction extends Model
{
    use HasFactory;
    public $table = 'directions';

    public $fillable = ['name'];

    public $timestamps = false;

    // ko'pga bir bog'lanish group jadval bilan
    public function getGroup(){
        return $this->hasMany(Group::class, 'direction_id', 'id');
    }
}
