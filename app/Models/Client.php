<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'wechat'
    ];

    public function address() {
        return $this->hasOne('App\Models\Address');
    }

    public function order() {
        return $this->hasMany('App\Models\Order');
    }

}
