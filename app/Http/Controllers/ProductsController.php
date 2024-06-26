<?php
namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\ReservationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
class ProductsController extends Controller
{
    // functie voor het ophalen van de producten uit de database
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
    // functie voor het ophalen van de reserveringen van de gebruiker
    public function index3()
    {
        $user = auth()->user()->name;
        $reservations = DB::table('reservations')
                        ->where('name', $user)
                        ->whereNotNull('expires_at')
                        ->get();
        $producten = [];
        $count = 0;
        $i = 0;
        foreach ($reservations as $reservation) {
            $product = DB::table('uitleendienst_inventaris')->where('id', $reservation->id)->first();
            $found = false;
            foreach ($producten as $key => $item) {
                if ($item->date == $reservation->date && $item->title == $product->title && $reservation->expires_at !== null) {
                    $producten[$key]->count++;
                    $count++;
                    $found = true;
                    break;
                }
            }
            if (!$found && $reservation->expires_at !== null) {
                $startDate = Carbon::parse($reservation->date);
                $endDate = $startDate->copy()->addDays(5)->format('Y-m-d');
                $producten[$i] = (object) [
                    'id' => $reservation->id,
                    'date' => $startDate->format('Y-m-d'),
                    'enddate' => $endDate,
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
    // functie voor het versturen van een mail naar de gebruiker met de reserveringen
    // en het updaten van de reserveringen in de database zodat ze niet meer verlopen
    public function timestamp(){
        $user = auth()->user()->name;
        $reservations = DB::table('reservations')
                        ->where('name', $user)
                        ->whereNotNull('expires_at')
                        ->get();
        $producten = [];
        $count = 0;
        $i = 0;
        $reservationIdsToUpdate = [];
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
                $startDate = Carbon::parse($reservation->date);
                $endDate = $startDate->copy()->addDays(4)->format('Y-m-d');

                $producten[$i] = (object) [
                    'id' => $reservation->id,
                    'date' => $startDate->format('Y-m-d'),
                    'enddate' => $endDate,
                    'title' => $product->title,
                    'merk' => $product->merk,
                    'category' => $product->category,
                    'beschrijving' => $product->beschrijving,
                    'count' => 1,
                ];
                $count++;
                $i++;
            }
            $reservationIdsToUpdate[] = $reservation->id;
        }

        Mail::to(Auth::user()->email)->queue(new ReservationMail($user, $producten));
        DB::table('reservations')
            ->whereIn('id', $reservationIdsToUpdate)
            ->update(['expires_at' => null]);



        return redirect('home');
    }
    // functie voor het deleten van een item uit de winkelmand aan de hand van het id
    public function delete($id)
    {
        try {
            $deletedRows = DB::table('reservations')
                ->where('id', '=', $id)
                ->delete();
            return redirect('reservatieoverzicht');
            
        } catch (\Exception $e) {
            \Log::error('Error deleting product: ' . $e->getMessage());
            return redirect('reservatieoverzicht');
        }
    }
    // functie voor het annuleren van een reservering aan de hand van het id
    // ook toegevoeg dat er enkel geannuleerd kan worden als de datum van de reservering nog niet is verstreken
    public function annuleer($id)
    {
        try {
            $deletedRows = DB::table('reservations')
                ->where('id', '=', $id)
                ->whereDate('date', '>', now())
                ->delete();

            if ($deletedRows > 0) {
                return redirect('itemlist');
            } else {
                return redirect('itemlist')->with('error', 'Deze reservering kan niet meer geannuleerd worden');
            }
        } catch (\Exception $e) {
            \Log::error('Error deleting product: ' . $e->getMessage());
            return redirect('itemlist');
        }
    }
}
