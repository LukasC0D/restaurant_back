<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'=> $this->name,
            'price'=> $this->price,
            'image'=> $this->image,
            'restaurant_id'=> $this->restaurant_id,
            'rating' => $this->ratings->avg('rating'),
            'restaurant_name'=> ($this->restaurant['name'] ?? "none"),
        ];
    }
}
