<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['libMarque'])]
class Marque extends Model
{
    public function vehicules(): HasMany
    {
        return $this->hasMany(Vehicule::class);
    }
}
