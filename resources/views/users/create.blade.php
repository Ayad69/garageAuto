@extends('layouts.app')

@section('title', 'Nouvel utilisateur')

@section('content')
    <form method="POST" action="{{ route('users.store') }}" class="max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('users._form')
        <x-form-actions :cancel-route="route('users.index')" />
    </form>
@endsection
