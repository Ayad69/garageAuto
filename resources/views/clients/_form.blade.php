<div class="grid gap-4 sm:grid-cols-2">
    <x-input name="nomClient" label="Nom" :value="$client->nomClient" required />
    <x-input name="prenomClient" label="Prénom" :value="$client->prenomClient" required />
    <x-input name="telClient" label="Téléphone" :value="$client->telClient" required />
    <x-input name="adresseClient" label="Adresse" :value="$client->adresseClient" required />
    <x-input name="villeClient" label="Ville" :value="$client->villeClient" required />
    <x-input name="codePostale" label="Code postal" :value="$client->codePostale" required />
</div>
