<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Beehive;
use App\Models\Queen;
use App\Http\Requests\BeehiveRequest;

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

        return view('beehives.index', compact('beehives', 'apiary'));
    }

    function addBeehiveToApiary($apiary) {
        $beehive = new Beehive();
        $path = 'beehives.store';
        $user = auth()->user();
        $freeQueens = Queen::
            where('user_id', $user->id)
            ->whereIn('id', function ($query) {
                $query->select('queen_id')->from('beehives');
            })->get();

          //  dd(count([]));

        // if(!count($freeQueens))
        //     dd('No hay reinas disponibles');
        
        // dd($freeQueens);

        return view('beehives.form', compact('beehive', 'path', 'freeQueens', 'apiary'));
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
        dd('hola');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        dd('hola');
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
