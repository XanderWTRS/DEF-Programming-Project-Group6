<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TerugbrengenInventaris extends Model
{
    use HasFactory;

    protected $table = 'uitleendienst_inventaris';

    public function reservation()
    {
        return $this->belongsTo(TerugbrengenReservatie::class, 'id');
    }
}
