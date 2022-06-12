<?php

namespace App\Actions;

use App\Http\Resources\AllProductsResource;
use App\Models\Product;
use Lorisleiva\Actions\Concerns\AsAction;

class GetProductDetail
{
    use AsAction;

    public function handle(Product $product)
    {

        return new AllProductsResource($product);
    }
}
