<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'tenant_id' => $this->tenant_id,
            'title' => $this->title,
            'identify' => $this->uuid,
            'image' => $this->image ? url("storage/{$this->image}") : "",
            'price' => $this->price,
            'description' => $this->description,
            'date' => Carbon::parse($this->created_at)->format('d/m/Y'),
        ];
    }
}
