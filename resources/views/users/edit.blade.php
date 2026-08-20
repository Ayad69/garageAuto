@extends('layouts.app')

@section('title', 'Modifier l\'utilisateur')

@section('content')
    <form method="POST" action="{{ route('users.update', $user) }}" class="max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')
        @include('users._form')
        <x-form-actions :cancel-route="route('users.index')" />
    </form>
@endsection
