<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    public $table = 'announcement';
    public $fillable = ['name', 'image','organization_id', 'thumb_image', 'app_begin','app_deadline', 'selection_begin','selection_date', 'description'];
    protected $dates = ['app_begin', 'app_deadline', 'selection_begin', 'selection_date'];
}
