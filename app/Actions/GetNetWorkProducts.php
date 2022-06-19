<?php

namespace App\Actions;

use App\Http\Resources\AllProductsResource;
use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNetWorkProducts
{
    use AsAction;

    public function handle()
    {
        $products=Product::query()->whereHas('categories',function ($query){
            $query->where('categories.id',1)
                ->orWhere('categories.parent_id',1);

        })->with(['comments.customer','categories','offer'])->visible()->take(10)->get();
        return AllProductsResource::collection($products);
    }
}
