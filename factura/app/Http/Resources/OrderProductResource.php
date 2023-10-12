<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id'=>$this->id,            
            'order_id'=>new OrderResource($this->order),
            'product_id'=>new ProductResource($this->product),
            'cuantity'=>$this->quantity,
            'estado'=>$this->estado,

        ];
    }
}
