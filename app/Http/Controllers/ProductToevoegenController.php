<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductToevoegen;

class ProductToevoegenController extends Controller
{
    public function index()
    {
        $products = ProductToevoegen::all();
        return view('admin.Producttoevoegen', ['products' => $products]); 
    }


    public function filterByCategory($category)
    {
        $products = ProductToevoegen::where('category', $category)->get();
        return view('admin.Producttoevoegen', ['products' => $products]);
    }

    public function destroy($id)
    {
    $product = ProductToevoegen::findOrFail($id);
    $product->delete();
    return redirect()->back()->with('success', 'Product succesvol verwijderd.');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:uitleendienst_inventaris,id',
            'title' => 'required|string|max:255',
            'beschrijving' => 'required|string',
            'category' => 'required|string',
            'merk' => 'required|string',
        ]);

        $product = ProductToevoegen::findOrFail($request->id);
        $product->update($validated);

        return redirect()->back()->with('success', 'Product updated successfully');
    }
    
}
