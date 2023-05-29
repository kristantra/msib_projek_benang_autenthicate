<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['fabric_variant_id', 'name', 'color_code', 'description', 'image', 'quantity', 'price'];

    public function fabricVariant()
    {
        return $this->belongsTo(FabricVariant::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
