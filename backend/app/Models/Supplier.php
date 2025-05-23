<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'supplier_name',
        'contact_name',
        'contact_email',
        'contact_phone',
        'address',
    ];

    public function items()
    {
        return $this->hasMany(Stock::class);
    }
    public function stocks()
    {
        return $this->belongsToMany(Stock::class, 'stock_supplier', 'supplier_id', 'stock_id');
    }
}