<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Modifier une tâche</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form action="{{ route('taches.update', $tache) }}" method="POST" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            {{-- Nom de la tâche --}}
            <div class="mb-4">
                <input type="text" name="nom" value="{{ $tache->nom }}" class="border px-3 py-2 rounded w-full" placeholder="Nom de la tâche" required>
            </div>

            {{-- Dates --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <input type="date" name="date_debut" value="{{ \Carbon\Carbon::parse($tache->date_debut)->format('Y-m-d') }}" required class="border rounded px-3 py-2 w-full">
                <input type="date" name="date_echeance" value="{{ \Carbon\Carbon::parse($tache->date_echeance)->format('Y-m-d') }}" required class="border rounded px-3 py-2 w-full">
            </div>

            {{-- Entreprise & Catégorie --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <input type="text" name="entreprise" value="{{ $tache->entreprise }}" required class="border rounded px-3 py-2 w-full">
                <input type="text" name="categorie" value="{{ $tache->categorie }}" required class="border rounded px-3 py-2 w-full">
            </div>

            {{-- Description --}}
            <textarea name="description" required class="border rounded px-3 py-2 w-full mb-4">{{ $tache->description }}</textarea>

            {{-- Priorité & Statut --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                <select name="priorite" class="border rounded px-3 py-2 w-full" required>
                    <option value="basse" @selected($tache->priorite === 'basse')>Basse</option>
                    <option value="moyenne" @selected($tache->priorite === 'moyenne')>Moyenne</option>
                    <option value="haute" @selected($tache->priorite === 'haute')>Haute</option>
                </select>

                <select name="statut" class="border rounded px-3 py-2 w-full" required>
                    <option value="en_attente" @selected($tache->statut === 'en_attente')>En attente</option>
                    <option value="en_cours" @selected($tache->statut === 'en_cours')>En cours</option>
                    <option value="terminee" @selected($tache->statut === 'terminee')>Terminée</option>
                    <option value="reportee" @selected($tache->statut === 'reportee')>Reportée</option>
                    <option value="annulee" @selected($tache->statut === 'annulee')>Annulée</option>
                </select>
            </div>

            {{-- Commentaire --}}
            <input type="text" name="commentaire" value="{{ $tache->commentaire }}" class="border rounded px-3 py-2 w-full mb-4" placeholder="Commentaire (facultatif)">

            {{-- Bouton --}}
            <button type="submit" class="bg-indigo-600 text-black font-bold px-4 py-2 rounded hover:bg-indigo-700">
                💾 Mettre à jour
            </button>
        </form>
    </div>
</x-app-layout>
