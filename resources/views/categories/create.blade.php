@extends('layouts.app')

@section('title', 'Nouvelle catégorie')

@section('content')
    <form method="POST" action="{{ route('categories.store') }}" class="max-w-xl space-y-4 rounded-xl bg-white p-6 shadow-sm">
        @csrf
        @include('categories._form')
        <x-form-actions :cancel-route="route('categories.index')" />
    </form>
@endsection
