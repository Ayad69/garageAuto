@php
    $roleOptions = $roles->pluck('libRole', 'id');
    $entrepriseOptions = $entreprises->pluck('nomEntreprise', 'id');
@endphp

<div class="grid gap-4 sm:grid-cols-2">
    <x-input name="name" label="Prénom" :value="$user->name" required />
    <x-input name="surname" label="Nom" :value="$user->surname" required />
    <x-input name="email" label="Email" type="email" :value="$user->email" required />
    <x-select name="role_id" label="Rôle" :options="$roleOptions" :value="$user->role_id" required />
    <x-select name="entreprise_id" label="Entreprise" :options="$entrepriseOptions" :value="$user->entreprise_id" required />
    <x-input name="password" label="Mot de passe{{ $user->exists ? ' (laisser vide pour ne pas changer)' : '' }}" type="password" :required="! $user->exists" />
</div>
