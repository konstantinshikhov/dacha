<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chemical extends Model
{
    protected $fillable = [
        'name',
        'manufacturer',
        'manufacturer_site',
        'logo_path',
        'vendor_code',
        'main_photo',
        'composition',
        'average_price',
        'currency',
        'description',
        'characteristics',
        'merchantability',
        'topselled',
        'responses',
    ];
}
