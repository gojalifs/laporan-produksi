<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductionModel extends Model
{
    use HasFactory;

    protected $table = 'productions';

    protected $fillable = [
        'product_id',
        'lot_number',
        'user_id',
        'departemen',
        'bagian',
        'status',
        'repair_ke',
    ];
}
