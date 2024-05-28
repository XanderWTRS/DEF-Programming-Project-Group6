<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddproductInventaris;

class AddproductInventarisController extends Controller
{
    public function create()
    {
        return redirect('/Producttoevoegen');
    }

    public function store(Request $request)
    {
        $request->validate([
            'merk' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'beschrijving' => 'required|string|max:255',
        ]);

        AddproductInventaris::create([
            'merk' => $request->input('merk'),
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'beschrijving' => $request->input('beschrijving'),
        ]);

        return redirect('/Producttoevoegen')->with('success', 'Product added successfully.');
    }
}
