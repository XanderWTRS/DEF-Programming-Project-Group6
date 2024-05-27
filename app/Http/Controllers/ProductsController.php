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
        if ($selectedWeek === null) {
            $selectedWeek = DB::table('reservations')
            ->orderBy('date')
            ->value('date');
            $reservedProducts = DB::table('reservations')
            ->where('date', '=', $selectedWeek)
            ->pluck('id')
            ->toArray();
        $query->whereNotIn('id', $reservedProducts);
        }
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

        $products = $query->inRandomOrder()->paginate(12);

        return view('home', compact('products', 'selectedWeek', 'selectedCategory', 'searchQuery'));
    }
    public function index3()
    {
        //test
        $user = auth()->user()->name;
        $reservations = DB::table('reservations')
                        ->where('name', $user)
                        ->get();
        $producten = [];
        $count = 0;
        $i = 0;
        foreach ($reservations as $reservation) {
            $product = DB::table('uitleendienst_inventaris')->where('id', $reservation->id)->first();
            $found = false;
            foreach ($producten as $key => $item) {
                if ($item->date == $reservation->date && $item->title == $product->title) {
                    $producten[$key]->count++;
                    $count++;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $producten[$i] = (object) [
                    'id' => $reservation->id,
                    'date' => $reservation->date,
                    'title' => $product->title,
                    'merk' => $product->merk,
                    'category' => $product->category,
                    'beschrijving' => $product->beschrijving,
                    'count' => 1,
                ];
                $count++;
                $i++;
            }
        }


        return view('reservatieoverzicht', compact('producten'));
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
