@extends('layouts.app')

@section('title', 'Client')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('clients.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $client->nomClient }} {{ $client->prenomClient }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('clients.edit', $client) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('clients.destroy', $client)" confirm="Supprimer ce client ?" />
        </div>
    </div>

    <div class="mb-6 grid gap-4 rounded-xl bg-white p-6 shadow-sm sm:grid-cols-2">
        <p><span class="text-slate-500">Nom :</span> {{ $client->nomClient }}</p>
        <p><span class="text-slate-500">Prénom :</span> {{ $client->prenomClient }}</p>
        <p><span class="text-slate-500">Utilisateur :</span>
            @if ($client->user)
                <a href="{{ route('users.show', $client->user) }}" class="text-amber-700 hover:underline">{{ $client->user->nomComplet() }}</a>
            @endif
        </p>
        <p><span class="text-slate-500">Téléphone :</span> {{ $client->telClient }}</p>
        <p><span class="text-slate-500">Email :</span> {{ $client->user?->email }}</p>
        <p><span class="text-slate-500">Adresse :</span> {{ $client->adresseClient }}</p>
        <p><span class="text-slate-500">Ville :</span> {{ $client->villeClient }} {{ $client->codePostale }}</p>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-3 font-medium">Véhicules ({{ $client->vehicules->count() }})</h3>
        @forelse ($client->vehicules as $vehicule)
            <p class="py-1 text-sm">
                <a href="{{ route('vehicules.show', $vehicule) }}" class="text-amber-700 hover:underline">
                    {{ $vehicule->immat }} — {{ $vehicule->marque?->libMarque }} {{ $vehicule->modele }}
                </a>
            </p>
        @empty
            <p class="text-sm text-slate-500">Aucun véhicule.</p>
        @endforelse
    </div>
@endsection
