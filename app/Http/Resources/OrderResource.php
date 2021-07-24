<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Client;
use App\Models\Wine;

class OrderResource extends JsonResource
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
            'paid' => $this->paid,
            'client_id' => $this->client_id,
            'wine_id' => $this->wine_id,
            'price' => $this->price,
            'profit' => $this->profit,
            'quantity' => $this->quantity,
            'client' => Client::findOrFail($this->client_id),
            'wine' => Wine::findOrFail($this->wine_id),
            'time' => $this->created_at->toFormattedDateString()
        ];;
    }
}
