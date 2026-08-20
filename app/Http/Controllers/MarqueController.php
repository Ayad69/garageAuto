<?php

namespace App\Http\Controllers;

use App\Models\Marque;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MarqueController extends Controller
{
    public function index(): View
    {
        $marques = Marque::latest()->paginate(10);

        return view('marques.index', compact('marques'));
    }

    public function create(): View
    {
        return view('marques.create', ['marque' => new Marque]);
    }

    public function store(Request $request): RedirectResponse
    {
        Marque::create($this->validated($request));

        return redirect()->route('marques.index')->with('success', 'Marque créée.');
    }

    public function show(Marque $marque): View
    {
        $marque->load('vehicules');

        return view('marques.show', compact('marque'));
    }

    public function edit(Marque $marque): View
    {
        return view('marques.edit', compact('marque'));
    }

    public function update(Request $request, Marque $marque): RedirectResponse
    {
        $marque->update($this->validated($request));

        return redirect()->route('marques.index')->with('success', 'Marque mise à jour.');
    }

    public function destroy(Marque $marque): RedirectResponse
    {
        try {
            $marque->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer cette marque : des véhicules y sont liés.');
        }

        return redirect()->route('marques.index')->with('success', 'Marque supprimée.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'libMarque' => ['required', 'string', 'max:255'],
        ]);
    }
}
