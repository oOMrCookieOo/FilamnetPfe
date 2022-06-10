<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCommentsResrouce extends JsonResource
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
            'comment'=>$this->content,
            'client_name'=>$this->customer->last_name .' '.$this->customer->first_name,
            'client_image'=>$this->customer->photo
        ];
    }
}
