<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id, 
            'name' => $this->name, 
            'grape' => $this->grape, 
            'year' => $this->year, 
            'description' => $this->description, 
            'price' => $this->price, 
            'stock_price' => $this->stock_price, 
            'size' => $this->size, 
            'cap' => $this->cap,
            'brand' => $this->brand, 
            'rewarded' => $this->rewarded, 
            'stock' => $this->stock
        ];
    }
}
