<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    const STATUS = [
        'ACTIVE' => 'Active',
        'INACTIVE' => 'Inactive'
    ];

    protected $fillable = [
        'name',
        'status',
        'supplier_id'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

    public function scopeActiveStatus($query)
    {
        return $query->where('status', self::STATUS['ACTIVE']);
    }
}
