<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Discount;
use App\Models\Product;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $total = 0;
        foreach ($data['items'] as $item) {
            $new_price = $this->getNewPrice($item);
            $total += $new_price * $item['qty'];
        }

        $data['total_price'] = $total;
        $data['sub_total'] = $total;
        $data['user_id']=auth()->id();

        return $data;
    }

    private function getNewPrice($product)
    {
        $product=Product::query()->find($product['product_id']);
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
}
