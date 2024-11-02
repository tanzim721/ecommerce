<?php

namespace App\Models;

use App\Enums\EmploymentType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CareerJob extends Model
{
    /** @use HasFactory<\Database\Factories\CareerJobFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'company_name',
        'employment_type',
        'role',
        'apply_url',
        'company_logo',
        'description',
        'salary',
    ];

    protected $casts = [
        'employment_type' => EmploymentType::class
    ];
}
