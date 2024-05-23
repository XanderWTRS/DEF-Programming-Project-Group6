<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(Request $request): View
    {
        $products = DB::table('uitleendienst_inventaris')->get();
        return view('home', compact('products'));
    }
}
