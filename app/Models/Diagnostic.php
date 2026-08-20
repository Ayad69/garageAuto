<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'dateDebut',
    'dateFin',
    'description',
    'status',
    'vehicule_id',
    'typeDiagnostic_id',
])]
class Diagnostic extends Model
{
    protected function casts(): array
    {
        return [
            'dateDebut' => 'date',
            'dateFin' => 'date',
        ];
    }

    public function vehicule(): BelongsTo
    {
        return $this->belongsTo(Vehicule::class);
    }

    public function typeDiagnostic(): BelongsTo
    {
        return $this->belongsTo(TypeDiagnostic::class, 'typeDiagnostic_id');
    }

    public function mecaniciens(): BelongsToMany
    {
        return $this->belongsToMany(Mecanicien::class, 'mecanicien_diagnostic')
            ->withPivot('commentaire', 'dateIntervention')
            ->withTimestamps();
    }
}
