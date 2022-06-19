<?php

namespace App\Actions;

use App\Http\Resources\AllProductsResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class GetProducts
{
    use AsAction;

    public function handle(Request $request)
    {

       $products = Product::query()
            ->when($request->filled('key_word'), function ($query) use ($request) {
                $query->where(function ($query) use ($request){
                    $query->likeName($request->key_word)
                        ->likeBrandName($request->key_word)
                        ->likeCategoryName($request->key_word)
                    ;
                });

            })
            ->when($request->filled('category'),function ($query)use ($request){
                    $query->where(function ($query) use ($request){
                        $query->whereHas('categories',function ($query)use ($request){
                            $query->where('categories.id',$request->category)
                                ->orWhere('categories.parent_id',$request->category)
                            ;
                        });
                    });
            })
            ->with(['comments.customer', 'categories', 'offer'])->visible()->paginate();
        return AllProductsResource::collection($products);

    }

}
