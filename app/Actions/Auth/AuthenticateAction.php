<?php

namespace App\Actions\Auth;

use App\Http\Resources\CustomerAuthResource;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\ActionRequest;
use Lorisleiva\Actions\Concerns\AsAction;

class AuthenticateAction
{
    use AsAction;

    public function handle(ActionRequest $request)
    {

        $customer=Customer::query()->where('uuid',$request->uuid)->first();

        if ($customer){
            return $this->genToken($customer);
        }
        return  $this->registerCustomer($request);

    }

    private function registerCustomer($request)
    {
        $customer=Customer::query()->create($this->getCustomerFields($request)+[
            'password'=>Hash::make(($request->password??'password'))
            ]);

        return $this->genToken($customer);
    }
    private function getCustomerFields($request){
        return $request->only([
            'last_name',
            'first_name',
            'phone',
            'email',
            'uuid'
        ]);
    }
    private function genToken($customer){
        $token = $customer->createToken(request()->uuid)->plainTextToken;

        return response([
            'status' => true,
            'msg' => '',
            'data'=>[
                'token' => $token,
                'customer' => new CustomerAuthResource($customer),
            ]
        ]);
    }

    public function rules()
    {
        if (!Customer::query()->where('uuid',request()->uuid)->exists()){
            return [
                'uuid' => 'required|unique:customers,uuid|string|max:255',
                'first_name' => 'nullable|sometimes|string|max:40',
                'last_name' => 'nullable|sometimes|string|max:40',
                'email' => 'nullable|sometimes|string|email|unique:customers',
                'phone' => 'nullable|sometimes|string|unique:customers',
            ];
        }
        return  [

        ];

    }
}
