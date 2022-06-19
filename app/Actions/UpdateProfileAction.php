<?php

namespace App\Actions;

use App\Http\Resources\CustomerAuthResource;
use Illuminate\Support\Facades\Auth;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateProfileAction
{
    use AsAction;

    public function handle(ActionRequest $request)
    {
       $customer= Auth::user();
       $customer->update($this->getCustomerFields($request));

       $token=$request->bearerToken();
        return response([
            'status' => true,
            'msg' => '',
            'data'=>[
                'token' => $token,
                'customer' => new CustomerAuthResource($customer),
            ]
        ]);


    }
    private function getCustomerFields($request){
        return $request->only([
            'last_name',
            'first_name',
            'phone',
            'email',
        ]);
    }
    public function rules(){
        return [
            'first_name' => 'required|string|max:40',
            'last_name' => 'required|string|max:40',
            'email' => 'required|string|email|unique:customers,email,'.\auth()->user()->id,
            'phone' => 'required|string|unique:customers,phone,'.\auth()->user()->id,
        ];
    }
}
