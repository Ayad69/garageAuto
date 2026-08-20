<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Models\Piece;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PieceController extends Controller
{
    public function index(): View
    {
        $pieces = Piece::with('categorie')->latest()->paginate(10);

        return view('pieces.index', compact('pieces'));
    }

    public function create(): View
    {
        return view('pieces.create', $this->formData(['piece' => new Piece]));
    }

    public function store(Request $request): RedirectResponse
    {
        Piece::create($this->validated($request));

        return redirect()->route('pieces.index')->with('success', 'Pièce créée.');
    }

    public function show(Piece $piece): View
    {
        $piece->load(['categorie', 'reparations']);

        return view('pieces.show', compact('piece'));
    }

    public function edit(Piece $piece): View
    {
        return view('pieces.edit', $this->formData(compact('piece')));
    }

    public function update(Request $request, Piece $piece): RedirectResponse
    {
        $piece->update($this->validated($request));

        return redirect()->route('pieces.index')->with('success', 'Pièce mise à jour.');
    }

    public function destroy(Piece $piece): RedirectResponse
    {
        try {
            $piece->reparations()->detach();
            $piece->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer cette pièce.');
        }

        return redirect()->route('pieces.index')->with('success', 'Pièce supprimée.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function formData(array $data): array
    {
        return array_merge($data, [
            'categories' => Categorie::orderBy('libCat')->get(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'nomPiece' => ['required', 'string', 'max:255'],
            'reference' => ['required', 'string', 'max:255'],
            'prix' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'categorie_id' => ['required', 'exists:categories,id'],
        ]);
    }
}
