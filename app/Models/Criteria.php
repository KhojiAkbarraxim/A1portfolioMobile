<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Criteria extends Model
{
    use HasFactory;
    public $table = 'criteria';
    public $fillable = ['announcement_id', 'name', 'score'];
    public function getAnnouncement(){
        return $this->belongsTo(Announcement::class,'announcement_id','id');
    }
    public $timestamps = false;
}
