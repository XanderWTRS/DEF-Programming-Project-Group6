<?php

namespace App\Http\Controllers;

use App\Models\Klaarzetten;
use Illuminate\Http\Request;
use App\Models\Bezet;

class KlaarzettenController extends Controller
{
    public function index()
{
    $reservations = Klaarzetten::all();

    foreach ($reservations as $reservation) {
        $reservation->product = Bezet::find($reservation->id);
    }

    return view('admin.Klaarzetten', compact('reservations'));
}
public function filter(Request $request)
{
    $start = $request->query('start');
    $end = $request->query('end');

    if (!$start || !$end) {
        return response()->json(['error' => 'Invalid date range'], 400);
    }

    $reservations = Klaarzetten::with('product')->whereBetween('date', [$start, $end])->get();
    return response()->json($reservations);
}

}

