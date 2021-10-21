<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['sku','name'];

    public function purchases()
    {
        return $this->hasMany(Purchase::class,'product_sku','sku');
    }
}
