<?php

namespace App\Http\Controllers;

use App\Models\Diagnostic;
use App\Models\Mecanicien;
use App\Models\TypeDiagnostic;
use App\Models\Vehicule;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DiagnosticController extends Controller
{
    public function index(): View
    {
        $diagnostics = Diagnostic::with(['vehicule', 'typeDiagnostic'])->latest()->paginate(10);

        return view('diagnostics.index', compact('diagnostics'));
    }

    public function create(): View
    {
        $diagnostic = new Diagnostic;
        $diagnostic->setRelation('mecaniciens', collect());

        return view('diagnostics.create', $this->formData(compact('diagnostic')));
    }

    public function store(Request $request): RedirectResponse
    {
        $diagnostic = Diagnostic::create($this->validated($request));
        $this->syncMecaniciens($request, $diagnostic);

        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic créé.');
    }

    public function show(Diagnostic $diagnostic): View
    {
        $diagnostic->load(['vehicule.client.user', 'typeDiagnostic', 'mecaniciens.user']);

        return view('diagnostics.show', compact('diagnostic'));
    }

    public function edit(Diagnostic $diagnostic): View
    {
        $diagnostic->load('mecaniciens.user');

        return view('diagnostics.edit', $this->formData(compact('diagnostic')));
    }

    public function update(Request $request, Diagnostic $diagnostic): RedirectResponse
    {
        $diagnostic->update($this->validated($request));
        $this->syncMecaniciens($request, $diagnostic);

        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic mis à jour.');
    }

    public function destroy(Diagnostic $diagnostic): RedirectResponse
    {
        try {
            $diagnostic->mecaniciens()->detach();
            $diagnostic->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer ce diagnostic.');
        }

        return redirect()->route('diagnostics.index')->with('success', 'Diagnostic supprimé.');
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    private function formData(array $data): array
    {
        return array_merge($data, [
            'vehicules' => Vehicule::with('client.user')->orderBy('immat')->get(),
            'typeDiagnostics' => TypeDiagnostic::orderBy('libTypeDiagnostic')->get(),
            'mecaniciens' => Mecanicien::with('user')->get(),
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
            'description' => ['required', 'string', 'max:255'],
            'status' => ['required', 'in:en_cours,fini,attente'],
            'vehicule_id' => ['required', 'exists:vehicules,id'],
            'typeDiagnostic_id' => ['required', 'exists:typeDiagnostics,id'],
        ]);
    }

    private function syncMecaniciens(Request $request, Diagnostic $diagnostic): void
    {
        $mecanicienIds = $request->input('mecanicien_ids', []);
        $mecaniciens = [];

        foreach ($mecanicienIds as $id) {
            $mecaniciens[$id] = [
                'commentaire' => $request->input("mecanicien_commentaire.$id", ''),
                'dateIntervention' => $request->input("mecanicien_date.$id") ?: now()->toDateString(),
            ];
        }

        $diagnostic->mecaniciens()->sync($mecaniciens);
    }
}
