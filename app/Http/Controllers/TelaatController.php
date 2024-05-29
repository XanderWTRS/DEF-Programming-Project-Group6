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

         $telaats = Telaat::select('id', 'name', 'date', 'user_id')
                             ->whereDate('date', '<=', $fourDaysAgo)
                             ->get();
return view('admin.Telaat', compact('telaats'));
    }
}
