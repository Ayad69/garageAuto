<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'dateDebut',
    'dateFin',
    'status',
    'vehicule_id',
    'typeReparation_id',
])]
class Reparation extends Model
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

    public function typeReparation(): BelongsTo
    {
        return $this->belongsTo(TypeReparation::class, 'typeReparation_id');
    }

    public function mecaniciens(): BelongsToMany
    {
        return $this->belongsToMany(Mecanicien::class, 'mecanicien_reparation')
            ->withPivot('commentaire', 'dateIntervention')
            ->withTimestamps();
    }

    public function pieces(): BelongsToMany
    {
        return $this->belongsToMany(Piece::class, 'piece_reparation')
            ->withPivot('quantite')
            ->withTimestamps();
    }
}
