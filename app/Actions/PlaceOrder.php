<?php

namespace App\Actions;

use App\Http\Resources\CustomerAuthResource;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class PlaceOrder
{
    use AsAction;

    public function handle(ActionRequest $request)
    {
        $products = Product::query()->with('offer')->find(Arr::pluck($request->items, 'id'));

        $tracking_code = 'OR-' . random_int(100000, 999999);
        while (Order::query()->where('tracking_code', $tracking_code)->exists()) {
            $tracking_code = 'OR-' . random_int(100000, 999999);
        }

        DB::beginTransaction();
        try {
            $order = Order::query()->create([
                'total_price' => 0,
                'sub_total' => 0,
                'tracking_code' => $tracking_code,
                'status' => 'new',
                'customer_id' => auth()->user()->id,
                'address' => $request->address,
                'details' => $request->details
            ]);

            $total_price = 0;
            foreach ($request->items as $item) {

                $product = $products->where('id', $item['id'])->first();
                $new_price = $this->getNewPrice($product);
                $total_price += $new_price * $item['qty'];

                $order->items()->create([
                    'name' => $product->name,
                    'sku' => $product->sku,
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'unit_price' => $new_price,
                ]);
            }

            $order->update([
                'total_price' => $total_price,
                'sub_total' => $total_price,
            ]);
            DB::commit();
        }catch (\Throwable $exception){
            DB::rollBack();
            return response([
                'status' => true,
                'msg' => 'Something went wrong!',
                "exception"=>$exception->getMessage()
            ],500);

        }

        return response([
            'status' => true,
            'msg' => 'Order placed successfully',
        ]);

    }

    private function getNewPrice($product)
    {
        if ($product->offer) {
            if ($product->offer->type === "fixed_amount") {
                $new_price = $product->price - $product->offer->value;
            } else {
                $new_price = $product->price - intval($product->offer->value * $product->price) / 100;
            }
        } else {
            $new_price = $product->price;
        }
        return $new_price;
    }

    public function rules()
    {
        return [
            'items' => ['array', 'required'],
            'items.*.id' => ['required', 'exists:products,id'],
            'address' => ['required' , 'string'],
            'detail' => ['nullable']
        ];
    }
}
