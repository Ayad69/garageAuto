@extends('layouts.app')

@section('title', 'Diagnostic')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('diagnostics.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $diagnostic->typeDiagnostic?->libTypeDiagnostic }} — {{ $diagnostic->vehicule?->immat }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('diagnostics.edit', $diagnostic) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('diagnostics.destroy', $diagnostic)" confirm="Supprimer ce diagnostic ?" />
        </div>
    </div>

    <div class="mb-6 grid gap-4 rounded-xl bg-white p-6 shadow-sm sm:grid-cols-2">
        <p><span class="text-slate-500">Véhicule :</span>
            <a href="{{ route('vehicules.show', $diagnostic->vehicule) }}" class="text-amber-700 hover:underline">{{ $diagnostic->vehicule?->immat }}</a>
        </p>
        <p><span class="text-slate-500">Client :</span> {{ $diagnostic->vehicule?->client?->nomComplet() }}</p>
        <p><span class="text-slate-500">Début :</span> {{ $diagnostic->dateDebut?->format('d/m/Y') }}</p>
        <p><span class="text-slate-500">Fin :</span> {{ $diagnostic->dateFin?->format('d/m/Y') }}</p>
        <p><span class="text-slate-500">Statut :</span> {{ $diagnostic->status }}</p>
        <p class="sm:col-span-2"><span class="text-slate-500">Description :</span> {{ $diagnostic->description }}</p>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-3 font-medium">Mécaniciens</h3>
        @forelse ($diagnostic->mecaniciens as $mecanicien)
            <p class="py-1 text-sm">
                <a href="{{ route('mecaniciens.show', $mecanicien) }}" class="text-amber-700 hover:underline">{{ $mecanicien->nomComplet() }}</a>
                — {{ $mecanicien->pivot->dateIntervention }}
                @if ($mecanicien->pivot->commentaire)
                    ({{ $mecanicien->pivot->commentaire }})
                @endif
            </p>
        @empty
            <p class="text-sm text-slate-500">Aucun mécanicien.</p>
        @endforelse
    </div>
@endsection
