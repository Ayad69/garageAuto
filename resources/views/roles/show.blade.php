@extends('layouts.app')

@section('title', 'Rôle')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('roles.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $role->libRole }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('roles.edit', $role) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('roles.destroy', $role)" confirm="Supprimer ce rôle ?" />
        </div>
    </div>

    <div class="rounded-xl bg-white p-6 shadow-sm">
        <h3 class="mb-3 font-medium">Utilisateurs ({{ $role->users->count() }})</h3>
        @forelse ($role->users as $user)
            <p class="py-1 text-sm">
                <a href="{{ route('users.show', $user) }}" class="text-amber-700 hover:underline">{{ $user->name }} {{ $user->surname }}</a>
            </p>
        @empty
            <p class="text-sm text-slate-500">Aucun utilisateur.</p>
        @endforelse
    </div>
@endsection
