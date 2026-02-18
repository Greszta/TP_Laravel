<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\VIlle;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::select()->orderby('nom')->paginate(15);
        return view('etudiant.index', ['etudiants' => $etudiants]); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $villes = Ville::all();
        return view('etudiant.create', compact('villes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'nom' => 'required|min:2|max:255',
            'adresse' => 'required',
            'telephone' => 'required|unique:etudiants',
            'email' => 'required|email|max:100|unique:etudiants',
            'date_de_naissance' => 'required|date',
            'ville_id' => 'required',
        ]);

        $etudiant = Etudiant::create([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'date_de_naissance' => $request->date_de_naissance,
            'ville_id' => $request->ville_id
        ]);

        return redirect()->route('etudiant.show', $etudiant->id)->with('success', 'Nouvel étudiant crée avec succes!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Etudiant $etudiant)
    {
        return view('etudiant.show', ['etudiant' => $etudiant]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiant $etudiant)
    {
        $villes = Ville::all();
        return view('etudiant.edit', ['etudiant' => $etudiant], compact('villes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiant $etudiant)
    {

        $request->validate([
            'nom' => 'required|min:2|max:255',
            'adresse' => 'required',
            'telephone' => 'required',
            'email' => 'required|email|max:100',
            'date_de_naissance' => 'required|date',
            'ville_id' => 'required',
        ]);

        $etudiant->update([
            'nom' => $request->nom,
            'adresse' => $request->adresse,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'date_de_naissance' => $request->date_de_naissance,
            'ville_id' => $request->ville_id
        ]);

        return redirect()->route('etudiant.show', $etudiant->id)->with('success', 'Informations mis à jour!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiant $etudiant)
    {
        $etudiant->delete();
        return redirect()->route('etudiant.index')->withSuccess('Étudiant supprimé avec succes!');
    }
}
