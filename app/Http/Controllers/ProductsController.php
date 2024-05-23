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

        $products = $query->paginate(9);

        return view('home', compact('products', 'selectedWeek', 'selectedCategory', 'searchQuery'));
    }
    public function index3()
    {
        $reservations = DB::table('reservations')
                        ->pluck('id')
                        ->toArray();
        $products = DB::table('uitleendienst_inventaris')
                        ->whereIn('id', $reservations)
                        ->get();

        // Get the week for each product
        $productWeeks = [];
        foreach ($products as $product) {
            $week = DB::table('reservations')
                    ->where('id', $product->id)
                    ->value('date');
            $productWeeks[$product->id] = $week;
        }

        return view('reservatieoverzicht', compact('products', 'productWeeks'));
    }
    public function delete($id)
    {
        try {
            $deletedRows = DB::table('reservations')
                ->where('id', '=', $id)
                ->delete();

            if ($deletedRows > 0) {
                return redirect('reservatieoverzicht');
            } else {
                return redirect('reservatieoverzicht');
            }
        } catch (\Exception $e) {
            \Log::error('Error deleting product: ' . $e->getMessage());
            return redirect('reservatieoverzicht');
        }
    }
}
