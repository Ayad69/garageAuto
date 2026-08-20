@extends('layouts.app')

@section('title', 'Modifier la marque')

@section('content')
    <form method="POST" action="{{ route('marques.update', $marque) }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('marques._form')
        <x-form-actions :cancel-route="route('marques.index')" />
    </form>
@endsection
