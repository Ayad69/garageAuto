@php
    $userOptions = $users->mapWithKeys(fn ($user) => [$user->id => $user->nomComplet().' ('.$user->email.')']);
@endphp

<x-select name="user_id" label="Utilisateur" :options="$userOptions" :value="$mecanicien->user_id" required />
@if ($users->isEmpty())
    <p class="mt-1 text-sm text-amber-700">Créez d’abord un utilisateur sans profil mécanicien.</p>
@endif
