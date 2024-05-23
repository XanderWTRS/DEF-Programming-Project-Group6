<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function show($id): View{
        $product = DB::table('uitleendienst_inventaris')->where('id', $id)->first();

        return view('users.reservations', ['product' => $product]);
    }
}
