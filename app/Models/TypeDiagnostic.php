<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table(name: 'typeDiagnostics')]
#[Fillable(['libTypeDiagnostic'])]
class TypeDiagnostic extends Model
{
    public function diagnostics(): HasMany
    {
        return $this->hasMany(Diagnostic::class, 'typeDiagnostic_id');
    }
}
