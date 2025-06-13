<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
            'invoice_id',
            'customer_name',
            'contact_no',
            'bill_date',
            'total_amount',
            'payable_amount',
            'discount_percent',
            'discount_amount',
            'paid_amount',
            'due_amount',
            'return_amount',
            'returned_status',
            'paid_status',
            'created_by',
            'updated_by'
        ];
}
