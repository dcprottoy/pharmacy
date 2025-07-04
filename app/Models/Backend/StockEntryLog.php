<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockEntryLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'medecine_id',
        'stock_qty',
        'stock_date',
        'mrr_id',
        'manufacture_date',
        'expiry_date'
    ];

}
