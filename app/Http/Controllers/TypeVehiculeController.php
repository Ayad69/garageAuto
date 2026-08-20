<?php

namespace App\Http\Controllers;

use App\Models\TypeVehicule;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypeVehiculeController extends Controller
{
    public function index(): View
    {
        $typeVehicules = TypeVehicule::latest()->paginate(10);

        return view('type-vehicules.index', compact('typeVehicules'));
    }

    public function create(): View
    {
        return view('type-vehicules.create', ['typeVehicule' => new TypeVehicule]);
    }

    public function store(Request $request): RedirectResponse
    {
        TypeVehicule::create($this->validated($request));

        return redirect()->route('type-vehicules.index')->with('success', 'Type de véhicule créé.');
    }

    public function show(TypeVehicule $typeVehicule): View
    {
        $typeVehicule->load('vehicules');

        return view('type-vehicules.show', compact('typeVehicule'));
    }

    public function edit(TypeVehicule $typeVehicule): View
    {
        return view('type-vehicules.edit', compact('typeVehicule'));
    }

    public function update(Request $request, TypeVehicule $typeVehicule): RedirectResponse
    {
        $typeVehicule->update($this->validated($request));

        return redirect()->route('type-vehicules.index')->with('success', 'Type de véhicule mis à jour.');
    }

    public function destroy(TypeVehicule $typeVehicule): RedirectResponse
    {
        try {
            $typeVehicule->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer ce type : des véhicules y sont liés.');
        }

        return redirect()->route('type-vehicules.index')->with('success', 'Type de véhicule supprimé.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'libTypeVehicule' => ['required', 'string', 'max:255'],
        ]);
    }
}
