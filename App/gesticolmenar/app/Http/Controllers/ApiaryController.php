<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apiary;
use App\Models\Place;

class ApiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       // dd('hola');
        $user = auth()->user()->id;
        $apiaries = Apiary::where('user_id', $user)->get();
        $placesName = Place::where('user_id', $user)->pluck('name');

        foreach ($apiaries as $key => $apiary) {
            $apiary['place_name'] = $placesName[$key];
            //dd($apiary->place_name, $key);
        }
        //dd($apiaries);
        return view('apiaries', compact('apiaries'));
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
    public function store(Request $request)
    {
        //
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
