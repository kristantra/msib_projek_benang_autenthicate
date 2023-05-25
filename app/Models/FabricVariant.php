<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FabricVariant extends Model
{
    use HasFactory;

    protected $fillable = ['fabric_type_id', 'name'];

    public function fabricType()
    {
        return $this->belongsTo(FabricType::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
