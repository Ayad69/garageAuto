@extends('layouts.app')

@section('title', 'Modifier la pièce')

@section('content')
    <form method="POST" action="{{ route('pieces.update', $piece) }}" class="max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('pieces._form')
        <x-form-actions :cancel-route="route('pieces.index')" />
    </form>
@endsection
