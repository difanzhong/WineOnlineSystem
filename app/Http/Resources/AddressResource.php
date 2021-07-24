<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'id'=>$this->id,
            'client_id'=>$this->client_id,
            'province' => $this->province, 
            'city' => $this->city, 
            'state' => $this->state, 
            'town' => $this->town,
            'village'=>$this->village,
            'street'=>$this->street
        ];
    }
}
