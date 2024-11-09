<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'firstname', 'lastname', 'othername', 'DOB', 'regnum', 'subclass_id', 'gender', 'password', 'status', 'profile'
    ];

    protected $appends = ['photo_url'];
    public function getPhotoUrlAttribute()
    {
        return url($this->photo);
    }

    public function subclass()
    {
        return $this->belongsTo(Subclass::class);
    }

    public function classGroup()
    {
        return $this->hasOneThrough(
            ClassGroup::class,
            Subclass::class,
            'id',         // Foreign key on Subclass table
            'id',         // Foreign key on ClassGroup table
            'subclass_id', // Local key on Student table
            'class_group_id' // Local key on Subclass table
        );
    }

    


    
}
