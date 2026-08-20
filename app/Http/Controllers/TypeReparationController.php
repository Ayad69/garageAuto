<?php

namespace App\Http\Controllers;

use App\Models\TypeReparation;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypeReparationController extends Controller
{
    public function index(): View
    {
        $typeReparations = TypeReparation::latest()->paginate(10);

        return view('type-reparations.index', compact('typeReparations'));
    }

    public function create(): View
    {
        return view('type-reparations.create', ['typeReparation' => new TypeReparation]);
    }

    public function store(Request $request): RedirectResponse
    {
        TypeReparation::create($this->validated($request));

        return redirect()->route('type-reparations.index')->with('success', 'Type de réparation créé.');
    }

    public function show(TypeReparation $typeReparation): View
    {
        $typeReparation->load('reparations.vehicule');

        return view('type-reparations.show', compact('typeReparation'));
    }

    public function edit(TypeReparation $typeReparation): View
    {
        return view('type-reparations.edit', compact('typeReparation'));
    }

    public function update(Request $request, TypeReparation $typeReparation): RedirectResponse
    {
        $typeReparation->update($this->validated($request));

        return redirect()->route('type-reparations.index')->with('success', 'Type de réparation mis à jour.');
    }

    public function destroy(TypeReparation $typeReparation): RedirectResponse
    {
        try {
            $typeReparation->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer ce type : des réparations y sont liées.');
        }

        return redirect()->route('type-reparations.index')->with('success', 'Type de réparation supprimé.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'libTypeReparation' => ['required', 'string', 'max:255'],
        ]);
    }
}
