<?php

namespace App\Actions;

use App\Models\FcmTokens;
use App\Traits\FcmTrait;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class SendNotif
{
    use AsAction;
    use FcmTrait;

    public function handle(Request $request)
    {

        foreach (FcmTokens::query()->get() as $token) {
            $reciver_token = $token->token;
            echo $this->sendNotification('Woo! New Products 🥳','A new product just hit the shelf\'s take a look 😎 ', 'http://localhost:3000/shopp', $reciver_token, asset('fcm.jpg'));
        }


    }

}
