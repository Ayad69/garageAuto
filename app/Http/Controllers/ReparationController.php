<?php

namespace App\Http\Controllers;

use App\Models\Mecanicien;
use App\Models\Piece;
use App\Models\Reparation;
use App\Models\TypeReparation;
use App\Models\Vehicule;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReparationController extends Controller
{
    public function index(): View
    {
        $reparations = Reparation::with(['vehicule', 'typeReparation'])->latest()->paginate(10);

        return view('reparations.index', compact('reparations'));
    }

    public function create(): View
    {
        $reparation = new Reparation;
        $reparation->setRelation('mecaniciens', collect());
        $reparation->setRelation('pieces', collect());

        return view('reparations.create', $this->formData(compact('reparation')));
    }

    public function store(Request $request): RedirectResponse
    {
        $reparation = Reparation::create($this->validated($request));
        $this->syncRelations($request, $reparation);

        return redirect()->route('reparations.index')->with('success', 'Réparation créée.');
    }

    public function show(Reparation $reparation): View
    {
        $reparation->load(['vehicule.client.user', 'typeReparation', 'mecaniciens.user', 'pieces']);

        return view('reparations.show', compact('reparation'));
    }

    public function edit(Reparation $reparation): View
    {
        $reparation->load(['mecaniciens.user', 'pieces']);

        return view('reparations.edit', $this->formData(compact('reparation')));
    }

    public function update(Request $request, Reparation $reparation): RedirectResponse
    {
        $reparation->update($this->validated($request));
        $this->syncRelations($request, $reparation);

        return redirect()->route('reparations.index')->with('success', 'Réparation mise à jour.');
    }

    public function destroy(Reparation $reparation): RedirectResponse
    {
        try {
            $reparation->mecaniciens()->detach();
            $reparation->pieces()->detach();
            $reparation->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer cette réparation.');
        }

        return redirect()->route('reparations.index')->with('success', 'Réparation supprimée.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function formData(array $data): array
    {
        return array_merge($data, [
            'vehicules' => Vehicule::with('client.user')->orderBy('immat')->get(),
            'typeReparations' => TypeReparation::orderBy('libTypeReparation')->get(),
            'mecaniciens' => Mecanicien::with('user')->get(),
            'pieces' => Piece::orderBy('nomPiece')->get(),
        ]);
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'dateDebut' => ['required', 'date'],
            'dateFin' => ['required', 'date', 'after_or_equal:dateDebut'],
            'status' => ['required', 'in:en_cours,fini,attente'],
            'vehicule_id' => ['required', 'exists:vehicules,id'],
            'typeReparation_id' => ['required', 'exists:typeReparations,id'],
        ]);
    }

    private function syncRelations(Request $request, Reparation $reparation): void
    {
        $mecanicienIds = $request->input('mecanicien_ids', []);
        $mecaniciens = [];

        foreach ($mecanicienIds as $id) {
            $mecaniciens[$id] = [
                'commentaire' => $request->input("mecanicien_commentaire.$id", ''),
                'dateIntervention' => $request->input("mecanicien_date.$id") ?: now()->toDateString(),
            ];
        }

        $reparation->mecaniciens()->sync($mecaniciens);

        $pieceIds = $request->input('piece_ids', []);
        $pieces = [];

        foreach ($pieceIds as $id) {
            $pieces[$id] = [
                'quantite' => (int) $request->input("piece_quantite.$id", 1),
            ];
        }

        $reparation->pieces()->sync($pieces);
    }
}
