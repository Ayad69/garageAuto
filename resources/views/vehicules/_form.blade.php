@php
    $clientOptions = $clients->mapWithKeys(fn ($client) => [$client->id => $client->nomComplet()]);
    $marqueOptions = $marques->pluck('libMarque', 'id');
    $typeOptions = $typeVehicules->pluck('libTypeVehicule', 'id');
@endphp

<div class="grid gap-4 sm:grid-cols-2">
    <x-input name="immat" label="Immatriculation" :value="$vehicule->immat" required />
    <x-input name="modele" label="Modèle" :value="$vehicule->modele" required />
    <x-input name="annee" label="Année" :value="$vehicule->annee" required />
    <x-input name="kilometrage" label="Kilométrage" type="number" :value="$vehicule->kilometrage" required />
    <x-input name="numeroChassis" label="N° châssis" :value="$vehicule->numeroChassis" required />
    <x-select name="client_id" label="Client" :options="$clientOptions" :value="$vehicule->client_id" required />
    <x-select name="marque_id" label="Marque" :options="$marqueOptions" :value="$vehicule->marque_id" required />
    <x-select name="type_vehicule_id" label="Type de véhicule" :options="$typeOptions" :value="$vehicule->type_vehicule_id" required />
</div>
