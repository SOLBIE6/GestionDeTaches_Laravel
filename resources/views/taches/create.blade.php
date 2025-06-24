<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Nouvelle tâche</h2>
    </x-slot>

    <div class="py-6 max-w-4xl mx-auto">
        <form action="{{ route('taches.store') }}" method="POST" class="bg-white p-6 rounded shadow space-y-4">
    @csrf

    {{-- Nom de la tâche --}}
    <div>
        <label for="nom" class="block text-sm font-medium text-gray-700">Nom de la tâche</label>
        <input type="text" name="nom" id="nom" class="border mt-1 px-3 py-2 rounded w-full" required>
    </div>

    {{-- Dates --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="date_debut" class="block text-sm font-medium text-gray-700">Date de début</label>
            <input type="date" name="date_debut" id="date_debut" class="border mt-1 px-3 py-2 rounded w-full" required>
        </div>
        <div>
            <label for="date_echeance" class="block text-sm font-medium text-gray-700">Date d’échéance</label>
            <input type="date" name="date_echeance" id="date_echeance" class="border mt-1 px-3 py-2 rounded w-full" required>
        </div>
    </div>

    {{-- Entreprise --}}
    <div>
        <label for="entreprise" class="block text-sm font-medium text-gray-700">Entreprise concernée</label>
        <input type="text" name="entreprise" id="entreprise" class="border mt-1 px-3 py-2 rounded w-full" required>
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" id="description" rows="3" class="w-full border mt-1 px-3 py-2 rounded" placeholder="Détails, objectifs…" required></textarea>
    </div>

    {{-- Catégorie & priorité --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="categorie" class="block text-sm font-medium text-gray-700">Catégorie</label>
            <input type="text" name="categorie" id="categorie" class="border mt-1 px-3 py-2 rounded w-full" required>
        </div>
        <div>
            <label for="priorite" class="block text-sm font-medium text-gray-700">Priorité</label>
            <select name="priorite" id="priorite" class="border mt-1 px-3 py-2 rounded w-full" required>
                <option value="">Choisir une priorité</option>
                <option value="basse">Basse</option>
                <option value="moyenne">Moyenne</option>
                <option value="haute">Haute</option>
            </select>
        </div>
    </div>

    {{-- Statut & commentaire --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="statut" class="block text-sm font-medium text-gray-700">Statut</label>
            <select name="statut" id="statut" class="border mt-1 px-3 py-2 rounded w-full" required>
                <option value="en_attente">En attente</option>
                <option value="en_cours">En cours</option>
                <option value="terminee">Terminée</option>
                <option value="reportee">Reportée</option>
                <option value="annulee">Annulée</option>
            </select>
        </div>
        <div>
            <label for="commentaire" class="block text-sm font-medium text-gray-700">Commentaire (facultatif)</label>
            <input type="text" name="commentaire" id="commentaire" class="border mt-1 px-3 py-2 rounded w-full">
        </div>
    </div>

    {{-- Bouton --}}
    <div class="flex justify-end">
        <button type="submit" class="inline-flex items-center bg-indigo-600 hover:bg-indigo-700 text-black font-semibold px-5 py-2 rounded shadow">
            🚀 Créer la tâche
        </button>
    </div>
</form>

    </div>
</x-app-layout>
