<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type_id',
        'name_eng'
    ];

     public function producttype(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

}
