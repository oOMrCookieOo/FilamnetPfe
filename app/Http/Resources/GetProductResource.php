<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class GetProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $ids=[$this->categories()->first()->id,$this->categories()->first()->parent_id];
        $related=Product::query()->whereHas('categories',function ($query) use ($ids){
            $query->whereIn('categories.id',$ids)
                ->orWhereHas('parent',function ($query) use ($ids){
                    $query->whereIn('categories.parent_id',$ids);
                });
        })->take(10)->get();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'description' => Str::markdown($this->description),
            'available_in_stock' => $this->qty > 0,
            'image' => $this->getFirstMedia('product-images')?->getFullUrl(),
            'price' => $this->price,
            'brand' => $this->brand->name,
            'category' => [
                'id'=>$this->categories->first()->id,
                'name'=>$this->categories->first()->name
            ] ,
            'parent_category' => [
                'id'=>$this->categories->first()->parent?->id,
                'name'=>$this->categories->first()->parent?->name
            ],
            'comments' => ProductCommentsResrouce::collection($this->comments),
            'has_offer' => (bool)$this->offer,
            'offer' => $this->offer?$this->getNewPrice($this->price, $this->offer):[],
            'related_products'=>AllProductsResource::collection($related)
        ];
    }

    private function getNewPrice($old_price, $offer)
    {

        if ($offer->type==="fixed_amount"){
            $new_price=$old_price-$offer->value;
            $percentage=100-intval(($new_price*100)/$old_price);

        }else{
            $new_price=$old_price-intval($offer->value*$old_price)/100;
            $percentage=intval($offer->value);

        }

        return [
            'price'=>$new_price,
            'percentage'=>$percentage
        ];
    }
}
