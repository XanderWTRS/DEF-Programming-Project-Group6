<?php

namespace App\Http\Controllers;

use App\Models\Klaarzetten;
use Illuminate\Http\Request;

class KlaarzettenController extends Controller
{
    public function index()
    {
        $reservations = Klaarzetten::all();
        return view('Admin/Klaarzetten', compact('reservations'));
    }

    public function filter(Request $request)
    {
        $start = $request->query('start');
        $end = $request->query('end');

        if (!$start || !$end) {
            return response()->json(['error' => 'Invalid date range'], 400);
        }

        $reservations = Klaarzetten::whereBetween('date', [$start, $end])->get();
        return response()->json($reservations);
    }
}
