<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductSubCategory extends Model
{
    use HasFactory;

    protected $fillable = [
            'product_type_id',
            'product_category_id',
            'name_eng'
        ];


     public function producttype(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

     public function productcategory(): BelongsTo
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
