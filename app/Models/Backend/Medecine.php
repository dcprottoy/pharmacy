<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medecine extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacturer',
        'name',
        'generic',
        'strength',
        'type',
        'use_for',
        'category'
    ];

}
