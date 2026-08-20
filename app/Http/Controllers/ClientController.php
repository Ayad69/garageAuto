<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClientController extends Controller
{
    public function index(): View
    {
        $clients = Client::with('user')->latest()->paginate(10);

        return view('clients.index', compact('clients'));
    }

    public function create(): View
    {
        return view('clients.create', $this->formData(new Client));
    }

    public function store(Request $request): RedirectResponse
    {
        Client::create($this->validated($request));

        return redirect()->route('clients.index')->with('success', 'Client créé.');
    }

    public function show(Client $client): View
    {
        $client->load(['user', 'vehicules.marque']);

        return view('clients.show', compact('client'));
    }

    public function edit(Client $client): View
    {
        return view('clients.edit', $this->formData($client));
    }

    public function update(Request $request, Client $client): RedirectResponse
    {
        $client->update($this->validated($request));

        return redirect()->route('clients.index')->with('success', 'Client mis à jour.');
    }

    public function destroy(Client $client): RedirectResponse
    {
        try {
            $client->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer ce client : des véhicules y sont liés.');
        }

        return redirect()->route('clients.index')->with('success', 'Client supprimé.');
    }

    /**
     * @return array<string, mixed>
     */
    private function formData(Client $client): array
    {
        $users = User::query()
            ->orderBy('surname')
            ->orderBy('name')
            ->get();

        return compact('client', 'users');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'nomClient' => ['required', 'string', 'max:255'],
            'prenomClient' => ['required', 'string', 'max:255'],
            'telClient' => ['required', 'string', 'max:255'],
            'adresseClient' => ['required', 'string', 'max:255'],
            'villeClient' => ['required', 'string', 'max:255'],
            'codePostale' => ['required', 'string', 'max:255'],
        ]);
    }
}
