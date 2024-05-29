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
        $productid = $id;

        $banned = DB::table('bans')->where('user_id', auth()->user()->id)->pluck('status')->first();

        $product = DB::table('uitleendienst_inventaris')
            ->select('title', 'category', 'merk')
            ->where('id', $id)
            ->first();

        $productids = DB::table('uitleendienst_inventaris')
            ->where('title', $product->title)
            ->pluck('id')
            ->toArray();
        
        $productidsCount = count($productids);


        $relatedproducts = DB::table('uitleendienst_inventaris')
        ->selectRaw('MAX(merk) AS merk, title, MAX(category) AS category, MAX(beschrijving) AS beschrijving, MAX(id) AS id')
        ->where('category', $product->category)
        ->where('id', '!=', $id)
        ->groupBy('title')
        ->inRandomOrder()
        ->limit(5)
        ->get();

        $dateThreeWeeksLater = Carbon::now()->addWeeks(8)->toDateString();
        $reserveringen = DB::table('reservations')->whereIn('id', $productids)->where('date', '>', $currentDate)->where('date', '<', $dateThreeWeeksLater)->get();
        return view('users.reservations', compact('product','reserveringen','productidsCount','relatedproducts','banned','productid'));
    }

    public function store(Request $request, $id)
    {
        try {
            $selected = Carbon::parse($request->input('selected_week'));
            $product = DB::table('uitleendienst_inventaris')->where('id', $id)->first();
            if (!$product) {
                return redirect('reservatieoverzicht')->with('error', 'Product not found.');
            }
            $productname = $product->title;
            $productids = DB::table('uitleendienst_inventaris')->where('title', $productname)->pluck('id');
            $startOfWeek = $selected->startOfWeek();

            if (auth()->check()) {
                $userRole = auth()->user()->role;
                if ($userRole == 'student') {
                    $available = 2;
                } else {
                    $available = 4;
                }
            } else {
                $available = 0;
            }

            if ($startOfWeek > Carbon::now()->startOfWeek()->addWeeks($available) || $startOfWeek < Carbon::now()->startOfWeek()) {
                return redirect()->back()->with(['error' => 'Je kan geen producten reserveren in het op deze week', 'alert' => 'Not permitted']);
            } else {
                $reserved = false;
                foreach ($productids as $productid) {
                    $reserveringen = DB::table('reservations')
                        ->where('id', $productid)
                        ->where('date', '=', $startOfWeek)
                        ->get();
                    if ($reserveringen->isEmpty()) {
                        $product = $productid;
                        $reserved = true;
                        break;
                    }
                }

                if (!$reserved) {
                    return redirect()->back()->with('error', 'No available product found for the selected week.');
                }

                $date = $selected;
                $expirationTime = now()->addHour();
                DB::table('reservations')->insert([
                    'id' => $product,
                    'date' => $date,
                    'user_id' => auth()->user()->id,
                    'name' => auth()->user()->name,
                    'expires_at' => $expirationTime
                ]);

                return redirect('reservatieoverzicht')->with('success', 'Reservation created successfully.');
            }
        } catch (\Exception $e) {
            Log::error('Error creating reservation: ' . $e->getMessage());
            return redirect('home')->with('error', 'An error occurred while creating the reservation.');
        }
    }
}
