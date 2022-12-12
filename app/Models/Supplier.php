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

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeActiveStatus($query)
    {
        return $query->where('status', self::STATUS['ACTIVE']);
    }
}
