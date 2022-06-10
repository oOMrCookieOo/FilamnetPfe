<?php

namespace App\Actions;

use App\Http\Resources\AllProductsResource;
use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class GetProducts
{
    use AsAction;

    public function handle()
    {

        $products=Product::query()->visible()->paginate();
        return AllProductsResource::collection($products);

    }
}
