<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        "employee_id",
        "date_max_vacation",
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
