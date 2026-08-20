<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategorieController extends Controller
{
    public function index(): View
    {
        $categories = Categorie::latest()->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('categories.create', ['categorie' => new Categorie]);
    }

    public function store(Request $request): RedirectResponse
    {
        Categorie::create($this->validated($request));

        return redirect()->route('categories.index')->with('success', 'Catégorie créée.');
    }

    public function show(Categorie $categorie): View
    {
        $categorie->load('pieces');

        return view('categories.show', compact('categorie'));
    }

    public function edit(Categorie $categorie): View
    {
        return view('categories.edit', compact('categorie'));
    }

    public function update(Request $request, Categorie $categorie): RedirectResponse
    {
        $categorie->update($this->validated($request));

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour.');
    }

    public function destroy(Categorie $categorie): RedirectResponse
    {
        try {
            $categorie->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer cette catégorie : des pièces y sont liées.');
        }

        return redirect()->route('categories.index')->with('success', 'Catégorie supprimée.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'libCat' => ['required', 'string', 'max:255'],
        ]);
    }
}
