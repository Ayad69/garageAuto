<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RoleController extends Controller
{
    public function index(): View
    {
        $roles = Role::latest()->paginate(10);

        return view('roles.index', compact('roles'));
    }

    public function create(): View
    {
        return view('roles.create', ['role' => new Role]);
    }

    public function store(Request $request): RedirectResponse
    {
        Role::create($this->validated($request));

        return redirect()->route('roles.index')->with('success', 'Rôle créé.');
    }

    public function show(Role $role): View
    {
        $role->load('users');

        return view('roles.show', compact('role'));
    }

    public function edit(Role $role): View
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role): RedirectResponse
    {
        $role->update($this->validated($request));

        return redirect()->route('roles.index')->with('success', 'Rôle mis à jour.');
    }

    public function destroy(Role $role): RedirectResponse
    {
        try {
            $role->delete();
        } catch (QueryException) {
            return back()->with('error', 'Impossible de supprimer ce rôle : des utilisateurs y sont liés.');
        }

        return redirect()->route('roles.index')->with('success', 'Rôle supprimé.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        return $request->validate([
            'libRole' => ['required', 'string', 'max:255'],
        ]);
    }
}
