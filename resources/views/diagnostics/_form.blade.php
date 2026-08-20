@php
    $vehiculeOptions = $vehicules->mapWithKeys(fn ($vehicule) => [$vehicule->id => $vehicule->immat.' — '.$vehicule->client?->nomComplet()]);
    $typeOptions = $typeDiagnostics->pluck('libTypeDiagnostic', 'id');
    $statusOptions = ['attente' => 'En attente', 'en_cours' => 'En cours', 'fini' => 'Terminé'];
    $selectedMecaniciens = old('mecanicien_ids', $diagnostic->mecaniciens->pluck('id')->all());
@endphp

<div class="grid gap-4 sm:grid-cols-2">
    <x-input name="dateDebut" label="Date de début" type="date" :value="$diagnostic->dateDebut?->format('Y-m-d')" required />
    <x-input name="dateFin" label="Date de fin" type="date" :value="$diagnostic->dateFin?->format('Y-m-d')" required />
    <x-select name="status" label="Statut" :options="$statusOptions" :value="$diagnostic->status ?? 'attente'" required />
    <x-select name="vehicule_id" label="Véhicule" :options="$vehiculeOptions" :value="$diagnostic->vehicule_id" required />
    <x-select name="typeDiagnostic_id" label="Type de diagnostic" :options="$typeOptions" :value="$diagnostic->typeDiagnostic_id" required />
    <div class="sm:col-span-2">
        <x-input name="description" label="Description" :value="$diagnostic->description" required />
    </div>
</div>

<div class="mt-6 space-y-3">
    <h3 class="font-medium">Mécaniciens</h3>
    @forelse ($mecaniciens as $mecanicien)
        @php
            $attached = $diagnostic->mecaniciens->firstWhere('id', $mecanicien->id);
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
