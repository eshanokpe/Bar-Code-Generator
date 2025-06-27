<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
     protected $fillable = [
        'barcode_data',
        'barcode_image',
        'code'
    ];
}
 