<?php

namespace App\Http\Controllers;

use App\Models\Klaarzetten;
use Illuminate\Http\Request;

class KlaarzettenController extends Controller
{
    public function index()
    {
        $reservations = Klaarzetten::all();
        return view('admin.Klaarzetten', compact('reservations'));
    }
}
