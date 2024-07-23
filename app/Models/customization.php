<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customization extends Model
{
    use HasFactory;

    protected $table = 'customization';

    protected $fillable = [
        'tenant_id',
        'logo_name',
        'logo_pic',
    ];
}
