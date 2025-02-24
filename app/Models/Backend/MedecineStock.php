<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedecineStock extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer',
        'name',
        'generic',
        'strength',
        'type',
        'use_for',
        'category',
        'medecine_id',
        'last_stock',
        'current_stock',
        'stock_per',
        'mrp_rate',
        'tp_rate',
        'stock_cell'
    ];
}
