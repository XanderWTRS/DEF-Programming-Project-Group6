<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Telaat;

class TelaatController extends Controller
{
    public function index()
    {
         $today = Carbon::today();

         $fourDaysAgo = $today->copy()->subDays(4);

         $telaats = Telaat::select('reservations.id', 'reservations.name', 'reservations.date', 'reservations.user_id', 'bans.status') 
         ->leftJoin('bans', 'reservations.user_id', '=', 'bans.user_id') 
         ->whereDate('reservations.date', '<=', $fourDaysAgo)
         ->get();

         foreach ($telaats as $telaat) {
            if (!$telaat->status) {
                $telaat->status = 'te laat';
            }
        }
return view('admin.Telaat', compact('telaats'));
    }
}
