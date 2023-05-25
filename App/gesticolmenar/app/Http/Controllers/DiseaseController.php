<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Disease;
use App\Http\Requests\DiseaseRequest;

class DiseaseController extends Controller
{
    
    public function save($disease, $request)
    {
        $disease->user_id = auth()->user()->id;
        $disease->beehive_id = $request->beehive_id;
        $disease->name = $request->name;
        $disease->treatment_start_date = $request->treatment_start_date;
        $disease->treatment_repeat_date = date("Y-m-d", strtotime($request->treatment_start_date . "+ " . $request->treatment_repeat_date . " days"));
        $disease->save();

        return redirect()->route('beehives.show', $request->beehive_id);
    }

    public function addDiseaseToBeehive(string $beehive)
    {

        $disease = new Disease();
        $path = 'diseases.store';
        $diseasesOptions = [
            'Escarabajo predador',
            'Loque americana',
            'Loque europea',
            'Varroa destructor',
            'Virus parálisis aguda',
            'Virus parálisis crónica',
            'Virus alas deformadas',
        ];

        return view('diseases.form', compact('disease', 'path', 'beehive', 'diseasesOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DiseaseRequest $request)
    {

        $disease = new Disease();
        $this->save($disease, $request);

        return redirect()->route('beehives.show', $request->beehive_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $disease = Disease::findOrFail($id);
        $path = 'diseases.update';
        $diseasesOptions = [
            'Escarabajo predador',
            'Loque americana',
            'Loque europea',
            'Varroa destructor',
            'Virus parálisis aguda',
            'Virus parálisis crónica',
            'Virus alas deformadas',
        ];
        $beehive = $disease->beehive_id;

        return view('diseases.form', compact('disease', 'path', 'beehive', 'diseasesOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DiseaseRequest $request, string $id)
    {
        
        $disease = Disease::findOrFail($id);
        $this->save($disease, $request);

        return redirect()->route('beehives.show', $request->beehive_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $disease = Disease::findOrFail($id);
        $disease->delete();

        return redirect()->route('beehives.show', $disease->beehive_id);
    }
}
