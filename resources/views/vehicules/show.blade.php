@extends('layouts.app')

@section('title', 'Véhicule')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('vehicules.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $vehicule->immat }} — {{ $vehicule->marque?->libMarque }} {{ $vehicule->modele }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('vehicules.edit', $vehicule) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('vehicules.destroy', $vehicule)" confirm="Supprimer ce véhicule ?" />
        </div>
    </div>

    <div class="mb-6 grid gap-4 rounded-xl bg-white p-6 shadow-sm sm:grid-cols-2">
        <p><span class="text-slate-500">Client :</span>
            <a href="{{ route('clients.show', $vehicule->client) }}" class="text-amber-700 hover:underline">
                {{ $vehicule->client?->nomComplet() }}
            </a>
        </p>
        <p><span class="text-slate-500">Type :</span> {{ $vehicule->typeVehicule?->libTypeVehicule }}</p>
        <p><span class="text-slate-500">Année :</span> {{ $vehicule->annee }}</p>
        <p><span class="text-slate-500">Kilométrage :</span> {{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km</p>
        <p class="sm:col-span-2"><span class="text-slate-500">Châssis :</span> {{ $vehicule->numeroChassis }}</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-3 font-medium">Réparations ({{ $vehicule->reparations->count() }})</h3>
            @forelse ($vehicule->reparations as $reparation)
                <p class="py-1 text-sm">
                    <a href="{{ route('reparations.show', $reparation) }}" class="text-amber-700 hover:underline">
                        {{ $reparation->typeReparation?->libTypeReparation }} — {{ $reparation->status }}
                    </a>
                </p>
            @empty
                <p class="text-sm text-slate-500">Aucune réparation.</p>
            @endforelse
        </div>
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-3 font-medium">Diagnostics ({{ $vehicule->diagnostics->count() }})</h3>
            @forelse ($vehicule->diagnostics as $diagnostic)
                <p class="py-1 text-sm">
                    <a href="{{ route('diagnostics.show', $diagnostic) }}" class="text-amber-700 hover:underline">
                        {{ $diagnostic->typeDiagnostic?->libTypeDiagnostic }} — {{ $diagnostic->status }}
                    </a>
                </p>
            @empty
                <p class="text-sm text-slate-500">Aucun diagnostic.</p>
            @endforelse
        </div>
    </div>
@endsection
