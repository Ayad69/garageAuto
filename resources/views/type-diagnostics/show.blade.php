@extends('layouts.app')

@section('title', 'Type de diagnostic')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('type-diagnostics.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $typeDiagnostic->libTypeDiagnostic }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('type-diagnostics.edit', $typeDiagnostic) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('type-diagnostics.destroy', $typeDiagnostic)" confirm="Supprimer ce type ?" />
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-3 font-medium">Diagnostics ({{ $typeDiagnostic->diagnostics->count() }})</h3>
        @forelse ($typeDiagnostic->diagnostics as $diagnostic)
            <p class="py-1 text-sm">
                <a href="{{ route('diagnostics.show', $diagnostic) }}" class="text-amber-700 hover:underline">
                    {{ $diagnostic->vehicule?->immat }} — {{ $diagnostic->dateDebut?->format('d/m/Y') }}
                </a>
            </p>
        @empty
            <p class="text-sm text-slate-500">Aucun diagnostic.</p>
        @endforelse
    </div>
@endsection
