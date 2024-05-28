<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Telaat extends Model
{
    protected $table = 'reservations'; // Aannemende dat de tabelnaam 'reservations' is
    protected $fillable = ['id', 'name', 'date', 'user_id']; // Voeg 'date' toe aan de lijst met vullingen
}
