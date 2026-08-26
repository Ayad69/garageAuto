@extends('layouts.app')

@section('title', 'Mécanicien')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('mecaniciens.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $mecanicien->nomMecanicien }} {{ $mecanicien->prenomMecanicien }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('mecaniciens.edit', $mecanicien) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('mecaniciens.destroy', $mecanicien)" confirm="Supprimer ce mécanicien ?" />
        </div>
    </div>

    <div class="mb-6 rounded-xl bg-white p-6 shadow-sm">
        <p><span class="text-slate-500">Nom :</span> {{ $mecanicien->nomMecanicien }}</p>
        <p><span class="text-slate-500">Prénom :</span> {{ $mecanicien->prenomMecanicien }}</p>
        <p><span class="text-slate-500">Login :</span> {{ $mecanicien->login }}</p>
        <p><span class="text-slate-500">Utilisateur :</span>
            @if ($mecanicien->user)
                <a href="{{ route('users.show', $mecanicien->user) }}" class="text-amber-700 hover:underline">{{ $mecanicien->user->nomComplet() }}</a>
            @endif
        </p>
        <p><span class="text-slate-500">Email :</span> {{ $mecanicien->user?->email }}</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-2">
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-3 font-medium">Réparations ({{ $mecanicien->reparations->count() }})</h3>
            @forelse ($mecanicien->reparations as $reparation)
                <p class="py-1 text-sm">
                    <a href="{{ route('reparations.show', $reparation) }}" class="text-amber-700 hover:underline">
                        {{ $reparation->vehicule?->immat }} — {{ $reparation->pivot->dateIntervention }}
                    </a>
                </p>
            @empty
                <p class="text-sm text-slate-500">Aucune réparation.</p>
            @endforelse
        </div>
        <div class="rounded-xl bg-white p-6 shadow-sm">
            <h3 class="mb-3 font-medium">Diagnostics ({{ $mecanicien->diagnostics->count() }})</h3>
            @forelse ($mecanicien->diagnostics as $diagnostic)
                <p class="py-1 text-sm">
                    <a href="{{ route('diagnostics.show', $diagnostic) }}" class="text-amber-700 hover:underline">
                        {{ $diagnostic->vehicule?->immat }} — {{ $diagnostic->pivot->dateIntervention }}
                    </a>
                </p>
            @empty
                <p class="text-sm text-slate-500">Aucun diagnostic.</p>
            @endforelse
        </div>
    </div>
@endsection
