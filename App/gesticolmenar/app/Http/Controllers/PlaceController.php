<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Http\Requests\PlaceRequest;

class PlaceController extends Controller
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
        $place = new Place();
        $path = 'places.store';
        
        return view('places.form', compact('place', 'path'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlaceRequest $request)
    {
        $place = new Place();
        $place->user_id = auth()->user()->id;
        $place->name = $request->name;
        $place->catastral_code = $request->catastral_code;
        $place->poligon = $request->poligon;
        $place->parcel = $request->parcel;
        $place->postal_code = $request->postal_code;
        if ($request->has_water == 'on') {
            $place->has_water = true;
        } else {
            $place->has_water = false;
        }
        $place->save();

        return redirect()->route('apiaries.index');
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
