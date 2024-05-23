<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    public function index(Request $request): View
    {
        $selectedWeek = $request->input('week');
        $selectedCategory = $request->input('category');
        $searchQuery = $request->input('query');

        $query = DB::table('uitleendienst_inventaris');

        if ($selectedWeek) {
            $reservedProducts = DB::table('reservations')
                ->where('date', '=', $selectedWeek)
                ->pluck('id')
                ->toArray();
            $query->whereNotIn('id', $reservedProducts);
        }

        if ($selectedCategory) {
            $query->where('category', $selectedCategory);
        }

        if ($searchQuery) {
            $query->where('title', 'like', '%' . $searchQuery . '%');
        }

        $products = $query->get();

        return view('home', compact('products', 'selectedWeek', 'selectedCategory', 'searchQuery'));
    }
}
