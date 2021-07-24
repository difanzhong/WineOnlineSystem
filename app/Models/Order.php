<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'paid', 'price', 'profit', 'quantity', 'wine_id', 'client_id'
    ];

    protected $casts = [
        'time'
    ];

    public function wines() {
        return $this->hasMany('App\Models\Wine');
    }

    public function client() {
        return $this->hasOne('App\Models\Client');
    }
}
