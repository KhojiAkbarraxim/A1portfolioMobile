<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommissionScore extends Model
{
    use HasFactory;
    protected $fillable = ['commission_id','application_id','criteria_id','announcement_id','score','desc'];
    public function getAnnouncement(){
        return $this->belongsTo(Announcement::class,'announcement_id','id');
    }
    public function getCommission(){
        return $this->belongsTo(Commission::class,'commission_id','id');
    }
    public function getCriteria(){
        return $this->belongsTo(Criteria::class,'criteria_id','id');
    }
    public function getApplication(){
        return $this->belongsTo(Applicationn::class,'application_id','id');
    }
}
