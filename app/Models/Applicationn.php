<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Applicationn extends Model
{
    use HasFactory;
    protected $table='applications';
    protected $fillable=['fullname', 'org_info', 'announcement_id', 'phone', 'status', 'file'];
    public function getAnnouncement(){
        return $this->belongsTo(Announcement::class, 'announcement_id', 'id');
    }
}
