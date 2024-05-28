<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Telaat; // Verander de naam van de geïmporteerde model

class TelaatController extends Controller
{
    public function index()
    {
         // Huidige datum
         $today = Carbon::today();

         // Bereken de datum van vier dagen geleden
         $fourDaysAgo = $today->copy()->subDays(4);
 
         // Selecteer alleen reserveringen die ouder zijn dan vier dagen geleden
         $telaats = Telaat::select('id', 'name', 'date', 'user_id')
                             ->whereDate('date', '<=', $fourDaysAgo)
                             ->get();
return view('admin.Telaat', compact('telaats'));
    }
}
