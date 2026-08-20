@extends('layouts.app')

@section('title', 'Nouvelle pièce')

@section('content')
    <form method="POST" action="{{ route('pieces.store') }}" class="max-w-3xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('pieces._form')
        <x-form-actions :cancel-route="route('pieces.index')" />
    </form>
@endsection
