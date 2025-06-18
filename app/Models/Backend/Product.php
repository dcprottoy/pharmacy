<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manufacturer',
        'product_type',
        'product_category',
        'product_sub_category',
        'generic',
        'strength',
        'use_for',
        'last_stock',
        'current_stock',
        'mrp_rate',
        'tp_rate',
        'stock_location',
        'stock_location_id',
        'stock_per',
        'total_stock',
        'total_sale',
        'manufacturer_id',
        'product_type_id',
        'product_category_id',
        'product_sub_category_id',
        'medicine_use_for_id'
    ];
}
