<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klaarzetten extends Model
{
    use HasFactory;

    protected $table = 'reservations';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'date',
        'id',
        'confirmed',
    ];

    public function product()
    {
        return $this->belongsTo(Bezet::class, 'id', 'id');
    }
    
}
