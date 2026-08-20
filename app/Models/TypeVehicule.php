<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table(name: 'typeVehicules')]
#[Fillable(['libTypeVehicule'])]
class TypeVehicule extends Model
{
    public function vehicules(): HasMany
    {
        return $this->hasMany(Vehicule::class);
    }
}
