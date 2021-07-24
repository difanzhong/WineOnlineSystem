<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Address extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'province', 'city', 'state', 'town', 'village', 'street', 'client_id'
    ];

    // public function client() {
    //     return $this->belongsTo('App\Models\Client');
    // }
}
