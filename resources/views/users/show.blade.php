@extends('layouts.app')

@section('title', 'Utilisateur')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <div>
            <a href="{{ route('users.index') }}" class="text-sm text-slate-500 hover:text-slate-700">← Retour</a>
            <h2 class="mt-1 text-xl font-semibold">{{ $user->name }} {{ $user->surname }}</h2>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('users.edit', $user) }}" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">Modifier</a>
            <x-delete-button :action="route('users.destroy', $user)" confirm="Supprimer cet utilisateur ?" />
        </div>
    </div>

    <div class="grid gap-4 rounded-xl bg-white p-6 shadow-sm sm:grid-cols-2">
        <p><span class="text-slate-500">Email :</span> {{ $user->email }}</p>
        <p><span class="text-slate-500">Rôle :</span>
            @if ($user->role)
                <a href="{{ route('roles.show', $user->role) }}" class="text-amber-700 hover:underline">{{ $user->role->libRole }}</a>
            @endif
        </p>
        <p class="sm:col-span-2"><span class="text-slate-500">Clients :</span>
            @forelse ($user->clients as $client)
                <a href="{{ route('clients.show', $client) }}" class="text-amber-700 hover:underline">{{ $client->nomComplet() }}</a>{{ $loop->last ? '' : ', ' }}
            @empty
                —
            @endforelse
        </p>
        <p><span class="text-slate-500">Profil mécanicien :</span>
            @if ($user->mecanicien)
                <a href="{{ route('mecaniciens.show', $user->mecanicien) }}" class="text-amber-700 hover:underline">{{ $user->mecanicien->nomComplet() }}</a>
            @else
                —
            @endif
        </p>
    </div>
@endsection
