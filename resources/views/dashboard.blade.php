@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['Clients', $counts['clients'], 'clients.index'],
            ['Véhicules', $counts['vehicules'], 'vehicules.index'],
            ['Réparations', $counts['reparations'], 'reparations.index'],
            ['Diagnostics', $counts['diagnostics'], 'diagnostics.index'],
            ['Pièces', $counts['pieces'], 'pieces.index'],
            ['Mécaniciens', $counts['mecaniciens'], 'mecaniciens.index'],
            ['Catégories', $counts['categories'], 'categories.index'],
            ['Marques', $counts['marques'], 'marques.index'],
            ['Entreprises', $counts['entreprises'], 'entreprises.index'],
        ] as [$label, $count, $route])
            <a href="{{ route($route) }}" class="rounded-xl bg-white p-5 shadow-sm transition hover:shadow-md">
                <p class="text-sm text-slate-500">{{ $label }}</p>
                <p class="mt-2 text-3xl font-semibold text-slate-900">{{ $count }}</p>
            </a>
        @endforeach
    </div>
@endsection
