<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineBank extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'manufacturer',
        'generic',
        'strength',
        'type',
        'use_for',
        'category'
    ];
}
