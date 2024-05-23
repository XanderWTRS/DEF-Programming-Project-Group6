<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function show($id): View{
        $currentDate = Carbon::now();
        $product = DB::table('uitleendienst_inventaris')->where('id', $id)->first();
        $productname = $product->title;
        $productids = DB::table('uitleendienst_inventaris')->where('title', $productname)->pluck('id');
        $productidsCount = $productids->count();
        $relatedproducts = DB::table('uitleendienst_inventaris')
        ->selectRaw('MAX(merk) AS merk, title, MAX(category) AS category, MAX(beschrijving) AS beschrijving, MAX(id) AS id')
        ->where('category', $product->category)
        ->where('id', '!=', $product->id)
        ->groupBy('title')
        ->inRandomOrder()
        ->limit(3)
        ->get();

        $dateThreeWeeksLater = Carbon::now()->addWeeks(3)->toDateString();
        $reserveringen = DB::table('reservations')->whereIn('id', $productids)->where('date', '>', $currentDate)->where('date', '<', $dateThreeWeeksLater)->get();
        return view('users.reservations', compact('product','reserveringen','productidsCount','relatedproducts'));
    }

    public function store(Request $request , $id)
        {
            $selected = Carbon::parse($request->input('selected_week'));

            $product = DB::table('uitleendienst_inventaris')->where('id', $id)->first();
            $productname = $product->title;
            $productids = DB::table('uitleendienst_inventaris')->where('title', $productname)->pluck('id');

            $startOfWeek = $selected->startOfWeek();

            foreach ($productids as $productid) {
                $reserveringen = DB::table('reservations')
                    ->where('id', $productid)
                    ->where('date', '>=', $startOfWeek)
                    ->get();
                if ($reserveringen->isEmpty()) {
                    $product = $productid;
                }
            }

            $date = $selected;
            DB::table('reservations')->insert([
                    'id' => $product,
                    'date' => $date,
                ]);

            return redirect('reservatieoverzicht');
        }
}
