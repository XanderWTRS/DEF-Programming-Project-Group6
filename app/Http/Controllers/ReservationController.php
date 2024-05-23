<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservationController extends Controller
{
    public function show($id): View{
        $product = DB::table('uitleendienst_inventaris')->where('id', $id)->first();
        $currentDate = Carbon::now();
        $productname = $product->title;
        $productids = DB::table('uitleendienst_inventaris')->where('title', $productname)->pluck('id');
        $productidsCount = $productids->count();
        $dateThreeWeeksLater = Carbon::now()->addWeeks(3)->toDateString();
        $reserveringen = DB::table('reservations')->whereIn('id', $productids)->where('date', '>', $currentDate)->where('date', '<', $dateThreeWeeksLater)->get();
        return view('users.reservations', compact('product','reserveringen','productidsCount'));
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
