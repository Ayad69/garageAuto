<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'nomPiece',
    'reference',
    'prix',
    'stock',
    'categorie_id',
])]
class Piece extends Model
{
    protected function casts(): array
    {
        return [
            'prix' => 'decimal:2',
        ];
    }

    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    public function reparations(): BelongsToMany
    {
        return $this->belongsToMany(Reparation::class, 'piece_reparation')
            ->withPivot('quantite')
            ->withTimestamps();
    }
}
