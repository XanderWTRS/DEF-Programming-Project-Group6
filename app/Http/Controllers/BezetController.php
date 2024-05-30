<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bezet;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class BezetController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('query'); 
        $query = DB::table('uitleendienst_inventaris');
    
        if ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%');
        }
    
        $products = $query->paginate(20);
    
        foreach ($products as $product) {
            $reservation = DB::table('reservations')
                ->where('id', $product->id)
                ->first();
    
            if ($reservation) {
                $product->status = 'Niet beschikbaar'; 
                $product->student_name = $reservation->name;
            } else {
                $product->status = 'Beschikbaar'; 
                $product->student_name = null;
            }
        }
    
        return view('admin.bezetscherm', [
            'products' => $products, 
            'searchQuery' => $searchQuery
        ]);
    }    

}
