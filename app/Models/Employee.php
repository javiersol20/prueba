<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected  $fillable = [
        'cod_employee',
        'name_employee',
        'department_employee',
        'days_free_employee',
    ];
}
