<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'firstname', 'lastname', 'email', 'phone', 'gender',
    ];

    public function subclasses()
    {
        return $this->belongsToMany(Subclass::class, 'subclass_teacher');
    }

    public function classGroups()
    {
        return ClassGroup::whereHas('subclasses', function ($query) {
            $query->whereHas('teachers', function ($query) {
                $query->where('teachers.id', $this->id);
            });
        })->get();
    }
}
