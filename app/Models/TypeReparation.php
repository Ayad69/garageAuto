<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table(name: 'typeReparations')]
#[Fillable(['libTypeReparation'])]
class TypeReparation extends Model
{
    public function reparations(): HasMany
    {
        return $this->hasMany(Reparation::class, 'typeReparation_id');
    }
}
