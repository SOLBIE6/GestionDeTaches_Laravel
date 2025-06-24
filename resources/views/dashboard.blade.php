<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   <div class="py-4 text-base md:text-lg"> {{-- police plus lisible --}}


        @php
            $user = auth()->user();
            $role = $user->role;
            $couleur = $role === 'admin' ? 'bg-purple-600' : 'bg-emerald-600';
            $emoji = $role === 'admin' ? '👨‍💼' : '👤';
        @endphp

        <div class="text-white {{ $couleur }} px-6 py-5 rounded-lg mb-6 shadow flex items-center justify-between">
            <h1 class="text-2xl font-bold">
                {{ $emoji }} Bienvenue, {{ $user->name }}
            </h1>
            <span class="text-base uppercase tracking-wide bg-white text-gray-800 px-3 py-1 rounded-full font-semibold shadow-sm">
                {{ strtoupper($role) }}
            </span>
        </div>

       @if ($user->role === 'admin')
    <div class="bg-gray-900 text-white shadow rounded p-4 mb-6">
        <h3 class="text-xl font-bold mb-6 border-b border-gray-700 pb-2">🧑‍💼 Tâches de tous les utilisateurs</h3>
        @if ($user->role === 'admin')
        <div class="flex justify-end mb-6">
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow">
                ➕ Ajouter un agent
            </a>
        </div>
    @endif
    <div class="space-y-6">
        {{-- Liste des utilisateurs --}}
        @forelse ($utilisateurs as $u)
            <div class="bg-gray-800 rounded-lg p-4 mb-6 shadow">
                <h4 class="text-lg font-semibold text-white mb-2">👤 {{ $u->name }} <span class="text-sm text-gray-400">({{ $u->email }})</span></h4>

                @forelse ($u->taches as $tache)
                    <div class="border-t border-gray-700 pt-3 mt-3">
                        <p class="font-bold text-lg text-white">{{ $tache->nom }}</p>
                        <p class="text-sm text-gray-300 italic">{{ $tache->description }}</p>

                        <p class="text-base text-gray-400 mt-1">
                            🏢 {{ $tache->entreprise }} |
                            📂 {{ $tache->categorie }} |
                            ⏱️ Priorité :
                            <span class="font-bold
                                @if($tache->priorite === 'haute') text-red-400
                                @elseif($tache->priorite === 'moyenne') text-yellow-300
                                @else text-green-400
                                @endif">
                                {{ ucfirst($tache->priorite) }}
                            </span>
                            |
                            📌 Statut :
                            <span class="font-bold
                                @if($tache->statut === 'terminee') text-green-500
                                @elseif($tache->statut === 'en_cours') text-yellow-500
                                @elseif($tache->statut === 'annulee') text-red-500
                                @elseif($tache->statut === 'reportee') text-blue-500
                                @else text-gray-300
                                @endif">
                                {{ ucfirst($tache->statut) }}
                            </span>
                        </p>

                        <p class="text-base text-gray-400">
                            🗓️ Du {{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($tache->date_echeance)->format('d/m/Y') }}
                        </p>

                        @if ($tache->commentaire)
                            <p class="text-base text-gray-400 italic mt-1">💬 {{ $tache->commentaire }}</p>
                        @endif

                        <div class="flex gap-2 mt-2">
                            <a href="{{ route('taches.edit', $tache) }}" class="text-blue-400 hover:underline text-sm font-semibold">✏️ Modifier</a>
                            <form method="POST" action="{{ route('taches.destroy', $tache) }}" onsubmit="return confirm('Supprimer cette tâche ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:underline text-sm font-semibold">🗑️ Supprimer</button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 mt-2">Aucune tâche enregistrée pour cet utilisateur.</p>
                @endforelse
            </div>
        @empty
            <p class="text-gray-400">Aucun utilisateur trouvé.</p>
        @endforelse
    </div>

    {{-- Tâches personnelles de l'admin --}}
<div class="bg-gray-900 text-white shadow rounded p-4 mb-6">
    
    <div class="flex justify-end mt-4">
        <a href="{{ route('taches.create') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-base font-semibold rounded hover:bg-indigo-700 transition">
            ➕ Ajouter une tâche personnelle
        </a>
    </div>
</div>

@endif





        @if ($user->role === 'utilisateur')
    {{-- Bouton d’ajout de tâche --}}
    <div class="flex justify-end mb-4">
        <a href="{{ route('taches.create') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-base font-semibold rounded hover:bg-indigo-700 transition">
            ➕ Ajouter une tâche
        </a>
    </div>
@endif

<h3 class="text-xl font-bold mb-4 text-white">📌 Mes Tâches</h3>

@forelse ($user->taches as $tache)
    <div class="bg-gray-800 text-white rounded-lg p-4 mb-3 shadow text-[16px] leading-relaxed">
        <div class="flex justify-between items-start">
            <div class="space-y-1.5">
                {{-- Nom de la tâche (titre principal) --}}
                <p class="font-bold text-2xl">{{ $tache->nom }}</p>

                {{-- Description --}}
                <p class="text-base text-gray-300 italic">{{ $tache->description }}</p>

                {{-- Détails entreprise / catégorie --}}
                <p class="text-base">
                    📂 <span class="capitalize font-semibold">{{ $tache->categorie }}</span> |
                    🏢 {{ $tache->entreprise }}
                </p>

                {{-- Priorité & statut --}}
                <p class="text-base">
                    ⏱️ Priorité :
                    <span class="px-2 py-0.5 rounded-full text-xl font-bold
                        @if($tache->priorite === 'haute') bg-red-500 text-white
                        @elseif($tache->priorite === 'moyenne') bg-yellow-400 text-black
                        @else bg-green-500 text-white
                        @endif">
                        {{ ucfirst($tache->priorite) }}
                    </span>

                    |
                    📌 Statut :
                    <span class="px-2 py-0.5 rounded-full text-base font-bold
                        @switch($tache->statut)
                            @case('terminee') bg-emerald-600 text-white @break
                            @case('en_cours') bg-yellow-500 text-black @break
                            @case('annulee') bg-red-700 text-white @break
                            @case('reportee') bg-blue-600 text-white @break
                            @case('en_attente') bg-gray-500 text-white @break
                            @default bg-gray-300 text-black
                        @endswitch">
                        {{ ucfirst($tache->statut) }}
                    </span>
                </p>

                {{-- Dates --}}
                <p class="text-base text-gray-400">
                    📅 Du {{ \Carbon\Carbon::parse($tache->date_debut)->format('d/m/Y') }} au {{ \Carbon\Carbon::parse($tache->date_echeance)->format('d/m/Y') }}
                </p>

                {{-- Commentaire --}}
                @if ($tache->commentaire)
                    <p class="text-base text-gray-400">💬 {{ $tache->commentaire }}</p>
                @endif
            </div>

            {{-- Actions --}}
            <div class="flex flex-col gap-2 mt-1 text-right">
                <a href="{{ route('taches.edit', $tache) }}" class="text-blue-400 hover:underline text-base font-semibold">✏️ Modifier</a>
                <form method="POST" action="{{ route('taches.destroy', $tache) }}" onsubmit="return confirm('Supprimer cette tâche ?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-400 hover:underline text-base font-semibold">🗑️ Supprimer</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <p class="text-gray-400 text-base">Aucune tâche enregistrée.</p>
@endforelse



    </div>
</x-app-layout>
