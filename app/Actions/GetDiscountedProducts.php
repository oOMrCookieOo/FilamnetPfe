<?php

namespace App\Actions;

use App\Http\Resources\AllProductsResource;
use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class GetDiscountedProducts
{
    use AsAction;

    public function handle()
    {
        $products=Product::query()->whereHas('offer')->with(['comments.user','categories','offer'])->visible()->take(10)->get();
        return AllProductsResource::collection($products);
    }
}
