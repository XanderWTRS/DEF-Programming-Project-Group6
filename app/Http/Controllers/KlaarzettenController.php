<?php

namespace App\Http\Controllers;

use App\Models\Klaarzetten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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

    public function confirm($id, Request $request)
    {
        try {
            $reservation = Klaarzetten::findOrFail($id);
            if ($reservation) {
                $confirmed = $request->input('confirmed');
                $reservation->confirmed = $confirmed;
                $reservation->save();
                return response()->json(['success' => true, 'confirmed' => $confirmed]); // Return the confirmed status
            }

            return response()->json(['success' => false], 404);
        } catch (\Exception $e) {
            Log::error('Error confirming reservation: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function confirmationStatus($id)
    {
        try {
            $reservation = Klaarzetten::findOrFail($id);
            return response()->json(['confirmed' => $reservation->confirmed]);
        } catch (\Exception $e) {
            Log::error('Error getting confirmation status: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
