<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerugbrengenReservatie extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    public function uitleendienstInventaris()
    {
        return $this->hasMany(TerugbrengenInventaris::class, 'id');
    }
}
