<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beehive;

class BeehiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($apiary)
    {
        //
        dd('hola');
    }

    public function beehivesApiary($apiary)
    {
        //
        $beehives = Beehive::where('apiary_id', $apiary)->paginate(8);
        //dd($beehives);

        return view('beehives', compact('beehives'));
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
