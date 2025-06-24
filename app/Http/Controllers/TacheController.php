<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\User;
use Illuminate\Http\Request;

class TacheController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taches = Tache::where('user_id', auth()->id())->get();

        return view('dashboard', compact('taches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $request->validate([
        'nom' => 'required|string|max:255',
        'date_debut' => 'required|date',
        'date_echeance' => 'required|date|after_or_equal:date_debut',
        'entreprise' => 'required|string|max:255',
        'description' => 'required|string',
        'categorie' => 'required|string|max:255',
        'priorite' => 'required|in:basse,moyenne,haute',
        'statut' => 'required|in:en_attente,en_cours,terminee,annulee,reportee',
        'commentaire' => 'nullable|string',
    ]);

    Tache::create([
        'nom' => $request->nom,
        'user_id' => auth()->id(),
        'date_debut' => $request->date_debut,
        'date_echeance' => $request->date_echeance,
        'entreprise' => $request->entreprise,
        'description' => $request->description,
        'categorie' => $request->categorie,
        'priorite' => $request->priorite,
        'statut' => $request->statut,
        'commentaire' => $request->commentaire,
    ]);

    return redirect()->route('/')->with('success', 'Tâche créée avec succès !');
}


    /**
     * Display the specified resource.
     */
    public function show(Tache $tache)
    {
        // Vérifier si l'utilisateur authentifié est le propriétaire de la tâche
        if ($tache->user_id !== auth()->id()) {
            abort(403, 'Accès interdit');
        }

        return view('taches.show', compact('tache'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tache $tache)
    {

        return view('taches.edit', compact('tache'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tache $tache)
    {
        

        $request->validate([
            'nom' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_echeance' => 'required|date|after_or_equal:date_debut',
            'entreprise' => 'required|string|max:255',
            'description' => 'required|string',
            'categorie' => 'required|string|max:255',
            'priorite' => 'required|in:basse,moyenne,haute',
            'statut' => 'required|in:en_attente,en_cours,terminee,annulee,reportee',
            'commentaire' => 'nullable|string',
        ]);

        $tache->update([
            'nom' => $request->nom,
            'date_debut' => $request->date_debut,
            'date_echeance' => $request->date_echeance,
            'entreprise' => $request->entreprise,
            'description' => $request->description,
            'categorie' => $request->categorie,
            'priorite' => $request->priorite,
            'statut' => $request->statut,
            'commentaire' => $request->commentaire,
        ]);

        return redirect()->route('/')->with('success', 'Tâche mise à jour avec succès !');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tache $tache)
    {
        // Vérifier si l'utilisateur authentifié est le propriétaire de la tâche
        $tache->delete();

        return redirect()->route('taches.index')->with('success', 'Tâche supprimée avec succès !');
    }
}
