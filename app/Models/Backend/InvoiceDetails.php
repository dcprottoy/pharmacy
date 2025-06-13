<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'product_id',
        'product_name',
        'bill_date',
        'expire_date',
        'mrp_price',
        'price',
        'quantity',
        'final_price',
        'discount_percent',
        'discount_amount',
        'created_by',
        'updated_by'
    ];

}
