<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'gender',
    ];

    public function subclass(): BelongsToMany
    {
        return $this->belongsToMany(Subclass::class);
    }

}
