@extends('layouts.app')

@section('title', 'Type de réparation')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('type-reparations.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $typeReparation->libTypeReparation }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('type-reparations.edit', $typeReparation) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('type-reparations.destroy', $typeReparation)" confirm="Supprimer ce type ?" />
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-3 font-medium">Réparations ({{ $typeReparation->reparations->count() }})</h3>
        @forelse ($typeReparation->reparations as $reparation)
            <p class="py-1 text-sm">
                <a href="{{ route('reparations.show', $reparation) }}" class="text-amber-700 hover:underline">
                    {{ $reparation->vehicule?->immat }} — {{ $reparation->dateDebut?->format('d/m/Y') }}
                </a>
            </p>
        @empty
            <p class="text-sm text-slate-500">Aucune réparation.</p>
        @endforelse
    </div>
@endsection
