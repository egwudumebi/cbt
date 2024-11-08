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

    // Going to create a Pivot table for this
    // public function classGroups(): HasManyThrough
    // {
    //     return $this->hasManyThrough(
    //         ClassGroup::class, // Final model
    //         Subclass::class,   // Intermediate model
    //         'teacher_id',      // Foreign key on Subclass table
    //         'id',              // Foreign key on ClassGroup table
    //         'id',              // Local key on Teacher table
    //         'class_group_id'   // Local key on Subclass table
    //     );
    // }

}
