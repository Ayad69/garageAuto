@extends('layouts.app')

@section('title', 'Mécaniciens')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <p class="text-sm text-slate-500">{{ $mecaniciens->total() }} mécanicien(s)</p>
        <a href="{{ route('mecaniciens.create') }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Ajouter</a>
    </div>

    <div class="overflow-hidden rounded-xl bg-white shadow-sm">
        <table class="min-w-full divide-y divide-slate-200 text-sm">
            <thead class="bg-slate-50 text-left text-slate-600">
                <tr>
                    <th class="px-4 py-3 font-medium">Nom</th>
                    <th class="px-4 py-3 font-medium">Login</th>
                    <th class="px-4 py-3 text-right font-medium">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse ($mecaniciens as $mecanicien)
                    <tr>
                        <td class="px-4 py-3">{{ $mecanicien->nomMecanicien }} {{ $mecanicien->prenomMecanicien }}</td>
                        <td class="px-4 py-3">{{ $mecanicien->login }}</td>
                        <td class="px-4 py-3 text-right space-x-3">
                            <a href="{{ route('mecaniciens.show', $mecanicien) }}" class="font-medium text-slate-600 hover:text-slate-900">Voir</a>
                            <a href="{{ route('mecaniciens.edit', $mecanicien) }}" class="font-medium text-amber-600 hover:text-amber-800">Modifier</a>
                            <x-delete-button :action="route('mecaniciens.destroy', $mecanicien)" confirm="Supprimer ce mécanicien ?" />
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-4 py-8 text-center text-slate-500">Aucun mécanicien.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $mecaniciens->links() }}</div>
@endsection
