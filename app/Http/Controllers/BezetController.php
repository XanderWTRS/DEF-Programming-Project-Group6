<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bezet;
use App\Models\Reservation;

class BezetController extends Controller
{
    public function index()
    {
        $products = Bezet::all();
        
        foreach ($products as $product) {
         
            $reservation = Reservation::where('id', $product->id)->first();
            
    
            if ($reservation) {
                $product->status = 'Niet beschikbaar'; 
            } else {
                $product->status = 'Beschikbaar'; 
            }
        }

        $data['products'] = $products;
        return view('admin.Bezetscherm', ['products' => $products]); 
    }

}
