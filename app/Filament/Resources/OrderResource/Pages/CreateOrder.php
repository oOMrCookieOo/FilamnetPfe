<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use App\Models\Discount;
use Filament\Resources\Pages\CreateRecord;

class CreateOrder extends CreateRecord
{
    protected static string $resource = OrderResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $total = 0;
        foreach ($data['items'] as $item) {
            $total += $item['unit_price'] * $item['qty'];
        }
        $discount=0;

        if ($data['discount']){
            $discount=Discount::query()->where('code',$data['discount'])->first()?->value;
        }
        $data['total_price'] = $total-$discount;
        $data['user_id']=auth()->id();

        return $data;
    }
}
