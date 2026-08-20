<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'user_id',
    'nomClient',
    'prenomClient',
    'telClient',
    'adresseClient',
    'villeClient',
    'codePostale',
])]
class Client extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicules(): HasMany
    {
        return $this->hasMany(Vehicule::class);
    }

    public function nomComplet(): string
    {
        return trim($this->nomClient.' '.$this->prenomClient);
    }
}
