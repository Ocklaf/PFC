<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beehive;
use App\Models\Queen;
use App\Http\Requests\BeehiveRequest;
use App\Models\Place;
use App\Models\Apiary;
use App\Models\Product;
use App\Models\Disease;

class BeehiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function beehivesApiary($apiary)
    {
        $beehives = Beehive::where('apiary_id', $apiary)->paginate(8);

        return view('beehives.index', compact('beehives', 'apiary'));
    }

    public function addBeehiveToApiary($apiary)
    {
        $beehive = new Beehive();
        $path = 'beehives.store';
        $user = auth()->user()->id;
        $freeQueens = Queen::
            where('user_id', $user)
            ->whereNotIn('id', function ($query) {
                $query->select('queen_id')->from('beehives');
            })->get();
        $apiaries = [];

        return view('beehives.form', compact('beehive', 'path', 'freeQueens', 'apiary', 'apiaries'));
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
    public function store(BeehiveRequest $request)
    {
        $beehive = new Beehive();
        $beehive->type = $request->type;
        $beehive->user_code = $request->user_code;
        $beehive->honey_frames = $request->honey_frames;
        $beehive->pollen_frames = $request->pollen_frames;
        $beehive->brood_frames = $request->brood_frames;
        $beehive->user_id = auth()->user()->id;
        $beehive->queen_id = $request->queen_id;
        $beehive->apiary_id = $request->apiary_id;
        $beehive->save();

        return redirect()->route('beehives.beehivesApiary', $beehive->apiary_id)->withSuccess('Colmena creada correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $beehive = Beehive::findOrFail($id);
        $beehive->place_name = Place::where('id', $beehive->apiary_id)->pluck('name')->first();
        $queen = Queen::where('id', $beehive->queen_id)->first();
        $products = Product::where('beehive_id', $id)->get();
        $diseases = Disease::where('beehive_id', $id)->get();

        return view('beehives.show', compact('beehive', 'queen', 'products', 'diseases'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $beehive = Beehive::findOrFail($id);
        $path = 'beehives.update';
        $user = auth()->user()->id;
        $actualQueen = Queen::where('id', $beehive->queen_id)->get();

        $freeQueens = Queen::
        where('user_id', $user)
        ->whereNotIn('id', function ($query) {
            $query->select('queen_id')->from('beehives');
        })->get();

        $freeQueens->prepend($actualQueen->first());

        $apiaries = Apiary::where('user_id', $user)->get();

        foreach ($apiaries as $apiary) {
            $apiary->place_name = Place::where('id', $apiary->place_id)->pluck('name')->first();
        }

        return view('beehives.form', compact('beehive', 'path', 'freeQueens', 'apiaries'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BeehiveRequest $request, string $id)
    {

        $beehive = Beehive::findOrFail($id);
        $beehive->type = $request->type;
        $beehive->user_code = $request->user_code;
        $beehive->honey_frames = $request->honey_frames;
        $beehive->pollen_frames = $request->pollen_frames;
        $beehive->brood_frames = $request->brood_frames;
        $beehive->user_id = auth()->user()->id;
        $beehive->apiary_id = $request->apiary_id;
        $beehive->queen_id = $request->queen_id;
        $beehive->save();

        return redirect()->route('beehives.beehivesApiary', $beehive->apiary_id)->withSuccess('Colmena actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $beehive = Beehive::findOrFail($id);
        
        $beehive->delete();

        return redirect()->route('beehives.beehivesApiary', $beehive->apiary_id)->withSuccess('Colmena eliminada correctamente');
    }
}
