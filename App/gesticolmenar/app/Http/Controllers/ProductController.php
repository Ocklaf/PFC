<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        $product->user_id = auth()->user()->id;
        $product->beehive_id = $request->beehive_id;
        $product->type = $request->type;
        $product->grams = $request->grams;
        $product->year = date('Y');
        $product->save();

        return redirect()->back()->withSuccess('Producto añadido correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        $product->user_id = auth()->user()->id;
        $product->beehive_id = $request->beehive_id;
        $product->type = $request->type;
        $product->grams = $request->grams;
        $product->year = date('Y');
        $product->save();

        return redirect()->back()->withSuccess('Producto actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);

        $product->delete();

        return redirect()->back()->withSuccess('Producto eliminado correctamente');
    }
}
