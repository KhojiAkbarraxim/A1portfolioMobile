<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Commission extends Model
{
    use HasFactory;

   public $table = 'commissions';
   public $fillable = ['announcement_id', 'name', 'phone','status'];

   public function tanlov(){
       return $this->belongsTo(Announcement::class,'announcement_id','id');
   }

}
