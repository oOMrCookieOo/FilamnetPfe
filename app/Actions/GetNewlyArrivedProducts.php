<?php

namespace App\Actions;

use App\Http\Resources\AllProductsResource;
use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class GetNewlyArrivedProducts
{
    use AsAction;

    public function handle()
    {
        $products=Product::query()->orderByDesc('created_at')->with(['comments.user','categories','offer'])->visible()->take(10)->get();
        return AllProductsResource::collection($products);
    }
}
