<?php

namespace App\Http\Controllers;

use App\Models\TypeDiagnostic;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TypeDiagnosticController extends Controller
{
    public function index(): View
    {
        $typeDiagnostics = TypeDiagnostic::latest()->paginate(10);

        return view('type-diagnostics.index', compact('typeDiagnostics'));
    }

    public function create(): View
    {
        return view('type-diagnostics.create', ['typeDiagnostic' => new TypeDiagnostic]);
    }

    public function store(Request $request): RedirectResponse
    {
        TypeDiagnostic::create($this->validated($request));

        return redirect()->route('type-diagnostics.index')->with('success', 'Type de diagnostic créé.');
    }

    public function show(TypeDiagnostic $typeDiagnostic): View
    {
        $typeDiagnostic->load('diagnostics.vehicule');

        return view('type-diagnostics.show', compact('typeDiagnostic'));
    }

    public function edit(TypeDiagnostic $typeDiagnostic): View
    {
        return view('type-diagnostics.edit', compact('typeDiagnostic'));
    }

    public function update(Request $request, TypeDiagnostic $typeDiagnostic): RedirectResponse
    {
        $typeDiagnostic->update($this->validated($request));

        return redirect()->route('type-diagnostics.index')->with('success', 'Type de diagnostic mis à jour.');
    }

    public function destroy(TypeDiagnostic $typeDiagnostic): RedirectResponse
    {
        try {
            $typeDiagnostic->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer ce type : des diagnostics y sont liés.');
        }

        return redirect()->route('type-diagnostics.index')->with('success', 'Type de diagnostic supprimé.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'libTypeDiagnostic' => ['required', 'string', 'max:255'],
        ]);
    }
}
