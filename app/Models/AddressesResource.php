<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddressesResource extends Model
{
    protected $fillable = [
        'code', 'name', 'level', 'pcode'
    ];
}
