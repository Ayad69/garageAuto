@extends('layouts.app')

@section('title', 'Modifier la catégorie')

@section('content')
    <form method="POST" action="{{ route('categories.update', $categorie) }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('categories._form')
        <x-form-actions :cancel-route="route('categories.index')" />
    </form>
@endsection
