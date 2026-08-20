@php
    $vehiculeOptions = $vehicules->mapWithKeys(fn ($vehicule) => [$vehicule->id => $vehicule->immat.' — '.$vehicule->client?->nomComplet()]);
    $typeOptions = $typeReparations->pluck('libTypeReparation', 'id');
    $statusOptions = ['attente' => 'En attente', 'en_cours' => 'En cours', 'fini' => 'Terminé'];
    $selectedMecaniciens = old('mecanicien_ids', $reparation->mecaniciens->pluck('id')->all());
    $selectedPieces = old('piece_ids', $reparation->pieces->pluck('id')->all());
@endphp

<div class="grid gap-4 sm:grid-cols-2">
    <x-input name="dateDebut" label="Date de début" type="date" :value="$reparation->dateDebut?->format('Y-m-d')" required />
    <x-input name="dateFin" label="Date de fin" type="date" :value="$reparation->dateFin?->format('Y-m-d')" required />
    <x-select name="status" label="Statut" :options="$statusOptions" :value="$reparation->status ?? 'attente'" required />
    <x-select name="vehicule_id" label="Véhicule" :options="$vehiculeOptions" :value="$reparation->vehicule_id" required />
    <x-select name="typeReparation_id" label="Type de réparation" :options="$typeOptions" :value="$reparation->typeReparation_id" required />
</div>

<div class="mt-6 space-y-3">
    <h3 class="font-medium">Mécaniciens</h3>
    @forelse ($mecaniciens as $mecanicien)
        @php
            $attached = $reparation->mecaniciens->firstWhere('id', $mecanicien->id);
        @endphp
        <div class="grid gap-3 rounded-lg border border-slate-200 p-3 sm:grid-cols-3">
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="mecanicien_ids[]" value="{{ $mecanicien->id }}" class="rounded border-slate-300" @checked(in_array($mecanicien->id, $selectedMecaniciens))>
                {{ $mecanicien->nomComplet() }}
            </label>
            <input type="date" name="mecanicien_date[{{ $mecanicien->id }}]" value="{{ old('mecanicien_date.'.$mecanicien->id, $attached?->pivot?->dateIntervention) }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
            <input type="text" name="mecanicien_commentaire[{{ $mecanicien->id }}]" value="{{ old('mecanicien_commentaire.'.$mecanicien->id, $attached?->pivot?->commentaire) }}" placeholder="Commentaire" class="rounded-lg border border-slate-300 px-3 py-2 text-sm">
        </div>
    @empty
        <p class="text-sm text-slate-500">Aucun mécanicien. Créez-en un d’abord.</p>
    @endforelse
</div>

<div class="mt-6 space-y-3">
    <h3 class="font-medium">Pièces</h3>
    @forelse ($pieces as $piece)
        @php
            $attachedPiece = $reparation->pieces->firstWhere('id', $piece->id);
        @endphp
        <div class="grid gap-3 rounded-lg border border-slate-200 p-3 sm:grid-cols-2">
            <label class="flex items-center gap-2 text-sm">
                <input type="checkbox" name="piece_ids[]" value="{{ $piece->id }}" class="rounded border-slate-300" @checked(in_array($piece->id, $selectedPieces))>
                {{ $piece->nomPiece }} ({{ $piece->reference }})
            </label>
            <input type="number" min="1" name="piece_quantite[{{ $piece->id }}]" value="{{ old('piece_quantite.'.$piece->id, $attachedPiece?->pivot?->quantite ?? 1) }}" class="rounded-lg border border-slate-300 px-3 py-2 text-sm" placeholder="Quantité">
        </div>
    @empty
        <p class="text-sm text-slate-500">Aucune pièce. Créez-en une d’abord.</p>
    @endforelse
</div>
