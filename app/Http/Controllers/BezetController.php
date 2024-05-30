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
        $statusFilter = $request->query('status');

        if ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%');
        }
        if ($statusFilter === 'Niet beschikbaar') {
            $productsQuery->whereHas('reservation'); // Filter to only include products that are not available
        }
        $products = Bezet::paginate(20);
        $productsQuery = Bezet::query();
        foreach ($products as $product) {
            $reservation = Reservation::where('id', $product->id)->first();
            
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
