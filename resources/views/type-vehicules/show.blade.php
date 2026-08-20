@extends('layouts.app')

@section('title', 'Type de véhicule')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('type-vehicules.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $typeVehicule->libTypeVehicule }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('type-vehicules.edit', $typeVehicule) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('type-vehicules.destroy', $typeVehicule)" confirm="Supprimer ce type ?" />
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-3 font-medium">Véhicules ({{ $typeVehicule->vehicules->count() }})</h3>
        @forelse ($typeVehicule->vehicules as $vehicule)
            <p class="py-1 text-sm">
                <a href="{{ route('vehicules.show', $vehicule) }}" class="text-amber-700 hover:underline">{{ $vehicule->immat }} — {{ $vehicule->modele }}</a>
            </p>
        @empty
            <p class="text-sm text-slate-500">Aucun véhicule.</p>
        @endforelse
    </div>
@endsection
