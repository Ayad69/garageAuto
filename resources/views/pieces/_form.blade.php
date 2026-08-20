@php
    $categorieOptions = $categories->pluck('libCat', 'id');
@endphp

<div class="grid gap-4 sm:grid-cols-2">
    <x-input name="nomPiece" label="Nom" :value="$piece->nomPiece" required />
    <x-input name="reference" label="Référence" :value="$piece->reference" required />
    <x-input name="prix" label="Prix" type="number" step="0.01" :value="$piece->prix" required />
    <x-input name="stock" label="Stock" type="number" :value="$piece->stock" required />
    <x-select name="categorie_id" label="Catégorie" :options="$categorieOptions" :value="$piece->categorie_id" required />
</div>
