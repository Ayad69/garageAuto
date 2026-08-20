<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['libCat'])]
class Categorie extends Model
{
    public function pieces(): HasMany
    {
        return $this->hasMany(Piece::class);
    }
}
