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
}
