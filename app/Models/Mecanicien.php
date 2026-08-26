<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable([
    'user_id',
    'nomMecanicien',
    'prenomMecanicien',
    'login',
    'password',
])]
#[Hidden(['password'])]
class Mecanicien extends Model
{
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function reparations(): BelongsToMany
    {
        return $this->belongsToMany(Reparation::class, 'mecanicien_reparation')
            ->withPivot('commentaire', 'dateIntervention')
            ->withTimestamps();
    }

    public function diagnostics(): BelongsToMany
    {
        return $this->belongsToMany(Diagnostic::class, 'mecanicien_diagnostic')
            ->withPivot('commentaire', 'dateIntervention')
            ->withTimestamps();
    }

    public function nomComplet(): string
    {
        return trim($this->nomMecanicien.' '.$this->prenomMecanicien);
    }
}
