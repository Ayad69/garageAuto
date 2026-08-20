@props(['cancelRoute'])

<div class="flex items-center gap-3 pt-2">
    <button type="submit" class="rounded-lg bg-amber-500 px-4 py-2 text-sm font-medium text-slate-900 hover:bg-amber-400">
        Enregistrer
    </button>
    <a href="{{ $cancelRoute }}" class="rounded-lg border border-slate-300 px-4 py-2 text-sm text-slate-700 hover:bg-slate-50">
        Annuler
    </a>
</div>
