<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class ClassGroup extends Model
{
    use HasFactory;
    
    protected $filable = ['name', 'code', 'population'];

    public function subclass(): HasManyThrough
    {
        return $this->hasManyThrough(
            Student::class,
            Subclass::class
        );
    }

    public function teachers(): HasManyThrough
    {
        return $this->hasManyThrough(
            Teacher::class,
            Subclass::class
        );
    }
    
}
