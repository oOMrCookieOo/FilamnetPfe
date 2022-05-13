<?php

namespace App\Filament\Resources\OrderResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;

class ListOrders extends ListRecords
{
    protected static string $resource = OrderResource::class;

//    protected function getDeleteBulkAction(): Tables\Actions\BulkAction
//    {
//        return parent::getDeleteBulkAction()
//            ->action(fn () => $this->notify(
//                'warning',
//                'Now, now, don’t be cheeky, leave some records for others to play with!',
//            ));
//    }
}
