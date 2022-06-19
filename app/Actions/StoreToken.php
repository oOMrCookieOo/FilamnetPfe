<?php

namespace App\Actions;

use App\Models\FcmTokens;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreToken
{
    use AsAction;

    public function handle(ActionRequest $request)
    {
        FcmTokens::query()->create([
            'token' => $request->token
        ]);

        return response()->json();
    }

    public function rules()
    {
        return [
            'token' => ['required']
        ];
    }
}
