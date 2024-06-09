<?php

namespace App\Http\Controllers;

use App\Models\TerugbrengenReservatie;
use App\Models\ResDone;
use Illuminate\Http\Request;

class TerugbrengenController extends Controller
{
    
    public function index()
    {
        return view('Admin.Terugbrengen');
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Zoek de reservation met de gegeven id en laadt de gerelateerde uitleendienst_inventaris gegevens
        $reservation = TerugbrengenReservatie::with('uitleendienstInventaris')->find($searchTerm);

        if (!$reservation) {
            return redirect()->back()->with('error', 'Reservation not found.');
        }

        return view('Admin.Terugbrengen', ['reservation' => $reservation, 'searchTerm' => $searchTerm]);
    }


    public function destroy($id)
    {
        $reservation = TerugbrengenReservatie::find($id);
        
        if ($reservation) {

            ResDone::create([
                'id' => $reservation->id,
                'name' => $reservation->name,
                'date' => $reservation->date,
            ]);

            $reservation->delete();
            return redirect()->route('admin.terugbrengen.index')->with('success', 'Reservation deleted successfully.');
        }

        return redirect()->route('admin.terugbrengen.index')->with('error', 'Reservation not found.');
    }

}
