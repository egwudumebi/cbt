<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname', 'lastname', 'othername', 'DOB', 'regnum', 'subclass_id', 'gender', 'password', 'status', 'profile'
    ];

    public function subclass()
    {
        return $this->belongsTo(Subclass::class);
    }

    public function classGroup()
    {
        return $this->hasManyThrough(
            ClassGroup::class,
            Subclass::class,
            'id',         // Foreign key on Subclass table
            'id',         // Foreign key on ClassGroup table
            'subclass_id', // Local key on Student table
            'class_group_id' // Local key on Subclass table
        );
    }


    
}
