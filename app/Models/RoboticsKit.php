<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoboticsKit extends Model
{
    protected $fillable = ['name'];
    
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
//relacion muchos a muchos 