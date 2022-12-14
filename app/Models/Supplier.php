<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    const STATUS = [
        'ACTIVE' => 'Active',
        'INACTIVE' => 'Inactive'
    ];

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'address',
        'status'
    ];
}
