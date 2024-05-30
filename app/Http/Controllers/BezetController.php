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
        $action = $request->input('action');
        $query = DB::table('uitleendienst_inventaris');

        if ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%');
        }

        if ($action === 'filter') {
            if ($request->session()->has('filtering')) {
                $request->session()->forget('filtering');
                $action = null;
            } else {
                $request->session()->put('filtering', true);
            }
        }

        if ($action === 'filter' || $request->session()->has('filtering')) {
            $query->join('reservations', 'uitleendienst_inventaris.id', '=', 'reservations.id')
                ->select('uitleendienst_inventaris.*', 'reservations.name as student_name');
        } else {
            $query->select('uitleendienst_inventaris.*');
        }

        $products = $query->paginate(20);

        foreach ($products as $product) {
            if ($action === 'filter' || $request->session()->has('filtering')) {
                $product->status = 'Niet beschikbaar';
            } else {
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
        }

        return view('admin.bezetscherm', [
            'products' => $products,
            'searchQuery' => $searchQuery,
            'action' => $action
        ]);
    }

}

