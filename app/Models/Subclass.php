<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subclass extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'population'];

    public function class_group(): BelongsTo
    {
        return $this->belongsTo(ClassGroup::class, 'class_id');
    }
}
