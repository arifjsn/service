<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Roles extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $guarded = ['id'];

    public function model_has_roles(): BelongsTo
    {
        return $this->belongsTo(ModelHasRoles::class);
    }
}
