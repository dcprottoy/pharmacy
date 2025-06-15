<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mrr extends Model
{
    use HasFactory;

    protected $fillable = [
            'mrr_id',
            'supplier_id',
            'supplier_name',
            'challan_no',
            'purchase_date',
            'bill_amount',
            'paid_amount',
            'due_amount',
            'approved',
            'paid_status',
            'created_by',
            'updated_by'
        ];
}