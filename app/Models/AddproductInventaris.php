<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddproductInventaris extends Model
{
    use HasFactory;

    protected $table = 'uitleendienst_inventaris';

    protected $fillable = ['id', 'merk', 'title', 'category', 'beschrijving'];

    public $timestamps = false;

}
