<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Apiary;
use App\Models\Place;
use App\Models\Beehive;

class ApiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = auth()->user()->id;
        $apiaries = Apiary::where('user_id', $user)->get();

        foreach ($apiaries as $apiary) {
            $apiary->place_name = Place::where('id', $apiary->place_id)->pluck('name')->first();
            $apiary->beehives_quantity = Beehive::where('apiary_id', $apiary->id)->count();
        }

        return view('apiaries.index', compact('apiaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apiary = new Apiary();
        $path = 'apiaries.store';
        $user = auth()->user()->id;
        //Lugares disponibles (no asignados a ningún colmenar de un usuario concreto)
        $freePlaces = Place::where('user_id', $user)
            ->whereNotIn('id', function ($query) {
                $query->select('place_id')->from('apiaries');
            })->get();

        return view('apiaries.form', compact('apiary', 'path', 'freePlaces'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $apiary = new Apiary();
        $apiary->user_id = auth()->user()->id;
        $apiary->place_id = $request->place_id;
        $apiary->beehives_quantity = 0;
        $apiary->save();

        return redirect()->route('apiaries.index')->withSuccess('Colmenar creado correctamente');
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

        $apiary = Apiary::findOrFail($id);

        $path = 'apiaries.update';
        $user = auth()->user()->id;

        //Lugares disponibles (no asignados a ningún colmenar de un usuario concreto)
        $freePlaces = Place::where('user_id', $user)
            ->whereNotIn('id', function ($query) {
                $query->select('place_id')->from('apiaries');
            })->get();

        return view('apiaries.form', compact('apiary', 'path', 'freePlaces'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $apiary = Apiary::findOrFail($id);
        $apiary->place_id = $request->place_id;
        $apiary->save();

        return redirect()->route('apiaries.index')->withSuccess('Colmenar actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $apiary = Apiary::findOrFail($id);

        $apiary->delete();

        return redirect()->route('apiaries.index');
    }
}
