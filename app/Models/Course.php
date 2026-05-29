<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CoursesFactory> */
    use HasFactory;

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    protected $fillable = [
        "name_course",
        "sku",
        "credits",
        "description"
    ];
}
