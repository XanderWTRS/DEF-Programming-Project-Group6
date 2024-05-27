<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bezet;
use App\Models\Reservation;

class BezetController extends Controller
{
    public function index()
    {
        $products = Bezet::paginate(20);
        
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

        $data['products'] = $products;
        return view('admin.Bezetscherm', ['products' => $products]); 
    }

}
