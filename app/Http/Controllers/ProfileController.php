<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = auth()->user()->name;
        $reservations = DB::table('reservations')
            ->where('name', $user)
            ->whereNull('expires_at')
            ->get();

        // Join the reservations and products tables
        $reservationsWithProducts = DB::table('reservations')   
            ->join('uitleendienst_inventaris', 'reservations.id', '=', 'uitleendienst_inventaris.id')
            ->where('reservations.name', $user)
            ->whereNull('reservations.expires_at')
            ->select('reservations.id', 'reservations.date', 'uitleendienst_inventaris.title','uitleendienst_inventaris.beschrijving', 'uitleendienst_inventaris.category')
            ->get();

        return view('profile.edit', [
            'user' => $request->user(),
            'reservationsWithProducts' => $reservationsWithProducts,
        ]);
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function page()
    {
        return view('adminDashboard');
    }
}
