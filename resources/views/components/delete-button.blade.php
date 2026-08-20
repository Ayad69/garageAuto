@props(['action', 'confirm' => 'Supprimer cet enregistrement ?'])

<form method="POST" action="{{ $action }}" onsubmit="return confirm(@js($confirm))" class="inline">
    @csrf
    @method('DELETE')
    <button type="submit" {{ $attributes->merge(['class' => 'text-sm font-medium text-red-600 hover:text-red-800']) }}>
        Supprimer
    </button>
</form>
