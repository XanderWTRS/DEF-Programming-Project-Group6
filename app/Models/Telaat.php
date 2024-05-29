<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telaat extends Model
{
    protected $table = 'reservations'; 
    protected $fillable = ['id', 'name', 'date', 'user_id']; 
}
