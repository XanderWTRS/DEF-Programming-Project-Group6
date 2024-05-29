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
        $query = DB::table('uitleendienst_inventaris');
        $searchQuery = $request->input('query');
        $statusFilter = $request->query('status'); // Get the status filter from the query parameters

        $productsQuery = Bezet::query();

        if ($statusFilter === 'Niet beschikbaar') {
            $productsQuery->whereHas('reservation'); // Filter to only include products that are not available
        }

        $products = $productsQuery->paginate(20);

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

        if ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%');
        }

        return view('admin.Bezetscherm', ['products' => $products], compact('searchQuery'));
    }
}
