@extends('layouts.app')

@section('title', 'Marque')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('marques.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $marque->libMarque }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('marques.edit', $marque) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('marques.destroy', $marque)" confirm="Supprimer cette marque ?" />
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-3 font-medium">Véhicules ({{ $marque->vehicules->count() }})</h3>
        @forelse ($marque->vehicules as $vehicule)
            <p class="py-1 text-sm">
                <a href="{{ route('vehicules.show', $vehicule) }}" class="text-amber-700 hover:underline">{{ $vehicule->immat }} — {{ $vehicule->modele }}</a>
            </p>
        @empty
            <p class="text-sm text-slate-500">Aucun véhicule.</p>
        @endforelse
    </div>
@endsection
