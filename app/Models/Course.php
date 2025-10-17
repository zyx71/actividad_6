<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\RoboticsKit;
use App\Models\User;

class Course extends Model
{
    protected $fillable = [
        'course_key',
        'course_name',
        'robotics_kit_id',
        'image',
    ];

    public function roboticsKit(): BelongsTo
    {
        return $this->belongsTo(RoboticsKit::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
