<?php

namespace App\Http\Controllers;

use App\Models\Mecanicien;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MecanicienController extends Controller
{
    public function index(): View
    {
        $mecaniciens = Mecanicien::with('user')->latest()->paginate(10);

        return view('mecaniciens.index', compact('mecaniciens'));
    }

    public function create(): View
    {
        return view('mecaniciens.create', $this->formData(new Mecanicien));
    }

    public function store(Request $request): RedirectResponse
    {
        Mecanicien::create($this->validated($request, new Mecanicien));

        return redirect()->route('mecaniciens.index')->with('success', 'Mécanicien créé.');
    }

    public function show(Mecanicien $mecanicien): View
    {
        $mecanicien->load(['user', 'reparations.vehicule', 'diagnostics.vehicule']);

        return view('mecaniciens.show', compact('mecanicien'));
    }

    public function edit(Mecanicien $mecanicien): View
    {
        return view('mecaniciens.edit', $this->formData($mecanicien));
    }

    public function update(Request $request, Mecanicien $mecanicien): RedirectResponse
    {
        $mecanicien->update($this->validated($request, $mecanicien));

        return redirect()->route('mecaniciens.index')->with('success', 'Mécanicien mis à jour.');
    }

    public function destroy(Mecanicien $mecanicien): RedirectResponse
    {
        try {
            $mecanicien->reparations()->detach();
            $mecanicien->diagnostics()->detach();
            $mecanicien->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer ce mécanicien.');
        }

        return redirect()->route('mecaniciens.index')->with('success', 'Mécanicien supprimé.');
    }

    /**
     * @return array<string, mixed>
     */
    private function formData(Mecanicien $mecanicien): array
    {
        $users = User::query()
            ->where(function ($query) use ($mecanicien) {
                $query->whereDoesntHave('mecanicien');

                if ($mecanicien->user_id) {
                    $query->orWhere('id', $mecanicien->user_id);
                }
            })
            ->orderBy('surname')
            ->orderBy('name')
            ->get();

        return compact('mecanicien', 'users');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request, Mecanicien $mecanicien): array
    {
        return $request->validate([
            'user_id' => ['required', 'exists:users,id', Rule::unique('mecaniciens', 'user_id')->ignore($mecanicien->id)],
        ]);
    }
}
