@php
    $userOptions = $users->mapWithKeys(fn ($user) => [$user->id => $user->nomComplet().' ('.$user->email.')']);
@endphp

<div class="grid gap-4 sm:grid-cols-2">
    <div class="sm:col-span-2">
        <x-select name="user_id" label="Utilisateur" :options="$userOptions" :value="$mecanicien->user_id" required />
        @if ($users->isEmpty())
            <p class="mt-1 text-sm text-amber-700">Créez d’abord un utilisateur sans profil mécanicien.</p>
        @endif
    </div>
    <x-input name="nomMecanicien" label="Nom" :value="$mecanicien->nomMecanicien" required />
    <x-input name="prenomMecanicien" label="Prénom" :value="$mecanicien->prenomMecanicien" required />
    <x-input name="login" label="Login" :value="$mecanicien->login" required />
    <x-input name="password" label="Mot de passe{{ $mecanicien->exists ? ' (laisser vide pour ne pas changer)' : '' }}" type="password" :required="! $mecanicien->exists" />
</div>
