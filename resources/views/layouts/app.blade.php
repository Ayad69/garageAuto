<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Garage Auto') — {{ config('app.name', 'Garage Auto') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-slate-100 text-slate-900">
        <div class="flex min-h-screen">
            <aside class="flex w-64 shrink-0 flex-col bg-slate-900 text-slate-100">
                <a href="{{ route('home') }}" class="border-b border-slate-800 px-6 py-5 text-lg font-semibold tracking-tight">
                    Garage Auto
                </a>
                <nav class="flex-1 space-y-6 overflow-y-auto p-4 text-sm">
                    @php
                        $navGroups = [
                            'Exploitation' => [
                                ['Clients', 'clients.index', 'clients.*'],
                                ['Véhicules', 'vehicules.index', 'vehicules.*'],
                                ['Réparations', 'reparations.index', 'reparations.*'],
                                ['Diagnostics', 'diagnostics.index', 'diagnostics.*'],
                                ['Pièces', 'pieces.index', 'pieces.*'],
                                ['Mécaniciens', 'mecaniciens.index', 'mecaniciens.*'],
                            ],
                            'Référentiels' => [
                                ['Catégories', 'categories.index', 'categories.*'],
                                ['Marques', 'marques.index', 'marques.*'],
                                ['Types de véhicules', 'type-vehicules.index', 'type-vehicules.*'],
                                ['Types de réparations', 'type-reparations.index', 'type-reparations.*'],
                                ['Types de diagnostics', 'type-diagnostics.index', 'type-diagnostics.*'],
                                ['Rôles', 'roles.index', 'roles.*'],
                                ['Entreprises', 'entreprises.index', 'entreprises.*'],
                                ['Utilisateurs', 'users.index', 'users.*'],
                            ],
                        ];
                    @endphp

                    @foreach ($navGroups as $group => $links)
                        <div>
                            <p class="mb-2 px-3 text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $group }}</p>
                            <div class="space-y-1">
                                @foreach ($links as [$label, $route, $active])
                                    <a
                                        href="{{ route($route) }}"
                                        class="block rounded-lg px-3 py-2 {{ request()->routeIs($active) ? 'bg-amber-500 font-medium text-slate-900' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
                                    >
                                        {{ $label }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </nav>
            </aside>

            <div class="flex min-w-0 flex-1 flex-col">
                <header class="border-b border-slate-200 bg-white px-8 py-4">
                    <h1 class="text-lg font-semibold">@yield('title', 'Garage Auto')</h1>
                </header>

                <main class="flex-1 p-8">
                    @if (session('success'))
                        <div class="mb-4 rounded-lg bg-emerald-50 px-4 py-3 text-sm text-emerald-800">{{ session('success') }}</div>
                    @endif

                    @if (session('error'))
                        <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-800">{{ session('error') }}</div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-800">
                            <ul class="list-inside list-disc space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </main>
            </div>
        </div>
    </body>
</html>
