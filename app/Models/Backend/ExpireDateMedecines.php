<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpireDateMedecines extends Model
{
    use HasFactory;

    protected $fillable = [
        'medecine_id',
        'stock_qty',
        'current_qty',
        'sell_qty',
        'stock_date',
        'expiry_date'
    ];

    
}
