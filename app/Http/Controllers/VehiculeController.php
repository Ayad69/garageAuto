<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Marque;
use App\Models\TypeVehicule;
use App\Models\Vehicule;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VehiculeController extends Controller
{
    public function index(): View
    {
        $vehicules = Vehicule::with(['client.user', 'marque', 'typeVehicule'])->latest()->paginate(10);

        return view('vehicules.index', compact('vehicules'));
    }

    public function create(): View
    {
        return view('vehicules.create', $this->formData(['vehicule' => new Vehicule]));
    }

    public function store(Request $request): RedirectResponse
    {
        Vehicule::create($this->validated($request));

        return redirect()->route('vehicules.index')->with('success', 'Véhicule créé.');
    }

    public function show(Vehicule $vehicule): View
    {
        $vehicule->load(['client.user', 'marque', 'typeVehicule', 'reparations.typeReparation', 'diagnostics.typeDiagnostic']);

        return view('vehicules.show', compact('vehicule'));
    }

    public function edit(Vehicule $vehicule): View
    {
        return view('vehicules.edit', $this->formData(compact('vehicule')));
    }

    public function update(Request $request, Vehicule $vehicule): RedirectResponse
    {
        $vehicule->update($this->validated($request));

        return redirect()->route('vehicules.index')->with('success', 'Véhicule mis à jour.');
    }

    public function destroy(Vehicule $vehicule): RedirectResponse
    {
        try {
            $vehicule->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer ce véhicule : des réparations ou diagnostics y sont liés.');
        }

        return redirect()->route('vehicules.index')->with('success', 'Véhicule supprimé.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function formData(array $data): array
    {
        return array_merge($data, [
            'clients' => Client::with('user')->get(),
            'marques' => Marque::orderBy('libMarque')->get(),
            'typeVehicules' => TypeVehicule::orderBy('libTypeVehicule')->get(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'immat' => ['required', 'string', 'max:255'],
            'modele' => ['required', 'string', 'max:255'],
            'annee' => ['required', 'string', 'max:255'],
            'kilometrage' => ['required', 'integer', 'min:0'],
            'numeroChassis' => ['required', 'string', 'max:255'],
            'marque_id' => ['required', 'exists:marques,id'],
            'type_vehicule_id' => ['required', 'exists:typeVehicules,id'],
            'client_id' => ['required', 'exists:clients,id'],
        ]);
    }
}
