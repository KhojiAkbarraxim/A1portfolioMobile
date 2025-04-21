<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Itb extends Model
{
    use HasFactory;
    public $table = 'itb_bolim';
    public $fillable = ['name', 'email', 'password'];
    public $timestamps = false;
}
