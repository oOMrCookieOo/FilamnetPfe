<?php

namespace App\Actions;

use App\Http\Resources\CustomerAuthResource;
use App\Models\Comment;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class PlaceComment
{
    use AsAction;

    public function handle(ActionRequest $request)
    {
        Comment::query()->create([
            'is_visible' => 0,
            'customer_id' => auth()->user()->id,
            'content' => $request->comment,
            'product_id' => $request->product_id
        ]);

        return response([
            'status' => true,
            'msg' => 'Comment placed successfully',
        ]);

    }


    public function rules()
    {
        return [
            'comment' => ['required'],
            'product_id' => ['required', 'exists:products,id']
        ];
    }
}
