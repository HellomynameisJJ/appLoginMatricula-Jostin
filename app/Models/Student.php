<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentsFactory> */
    use HasFactory;
    public $fillable = [
        "first_name",
        "last_name",
        "birth_date",
        "DNI",
        "address",
        "phone",
        "email",
        "registration_status"
    ];

}
