<?php

namespace App\Actions;

use App\Http\Resources\AllProductsResource;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetCategories
{
    use AsAction;

    public function handle(Request $request)
    {
        $categories=Category::query()->with('children')->get();
        return CategoriesResource::collection($categories);

    }
}
