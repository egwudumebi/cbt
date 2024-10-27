<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname', 'lastname', 'othername', 'DOB', 'regnum', 'class_id', 'subclass_id', 'gender', 'password', 'status', 'profile'
    ];

    public function classGroup(): HasOneThrough
    {
        return $this->hasOneThrough(
            ClassGroup::class, 
            Subclass::class,   
        );
    }



    
}
