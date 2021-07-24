<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Wine extends Model
{
    //
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'grape', 'year' ,'brand', 'cap', 'price', 'size', 'stock_price', 'description', 'stock', 'rewarded'
    ];
}
